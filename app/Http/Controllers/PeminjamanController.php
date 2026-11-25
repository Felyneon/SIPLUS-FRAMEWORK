<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdateStatusPeminjamanRequest;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PeminjamanController extends Controller
{
    public function index(Request $request): View
    {
        $status = $this->statusFilter($request);
        $user = Auth::user();
        $isPengelola = (int) session('user_role') === 1;

        $peminjamans = Peminjaman::with('ruangan')
            ->where('user_id', Auth::id())
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('peminjaman.index', compact('peminjamans', 'status', 'user', 'isPengelola'));
    }

    public function create(Request $request): View
    {
        $user = Auth::user();
        $isPengelola = (int) session('user_role') === 1;
        $ruanganId = $request->query('ruangan_id');
        $ruanganDipilih = Ruangan::find($ruanganId) ?? Ruangan::first();

        return view('peminjaman.create', compact('ruanganDipilih', 'user', 'isPengelola'));
    }

    public function store(StorePeminjamanRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $tersimpan = DB::transaction(function () use ($data) {
            // Mengunci baris ruangan agar perubahan status/jadwal tidak saling menimpa.
            $ruangan = Ruangan::whereKey($data['ruangan_id'])->lockForUpdate()->first();

            if (! $ruangan || $ruangan->status !== Ruangan::STATUS_TERSEDIA) {
                return false;
            }

            $mulai = $data['tanggal_mulai'];
            $selesai = $data['tanggal_selesai'];
            $keperluanFinal = $data['keperluan'];

            $bentrok = Peminjaman::where('ruangan_id', $ruangan->id)
                ->where('status', Peminjaman::STATUS_DISETUJUI)
                ->where('tanggal_mulai', '<', $selesai)
                ->where('tanggal_selesai', '>', $mulai)
                ->exists();

            if ($bentrok) {
                return false;
            }

            Peminjaman::create([
    'user_id'          => Auth::id(),
    'ruangan_id'       => $ruangan->id,

    // Informasi akademik
    'nama_matkul'      => $data['nama_matkul'],
    'dosen_pengampu'   => $data['dosen_pengampu'],
    'prodi'            => $data['prodi'],

    // Informasi peminjaman
    'tanggal_mulai'    => $mulai,
    'tanggal_selesai'  => $selesai,
    'keperluan'        => $keperluanFinal,

    // Status awal pengajuan
    'status'           => Peminjaman::STATUS_PENDING,
    'alasan_penolakan' => null,
]);

            return true;
        });

        if (! $tersimpan) {
            return back()->withInput()->withErrors([
                'ruangan_id' => 'Ruangan sudah tidak tersedia atau jadwalnya telah terisi.',
            ]);
        }

        return redirect()->route('peminjaman.index')
            ->with('success', 'Pengajuan peminjaman ruangan berhasil dikirim!');
    }

    public function destroy(Peminjaman $peminjaman): RedirectResponse
    {
        abort_unless((int) $peminjaman->user_id === (int) Auth::id(), 403);

        $dibatalkan = DB::transaction(function () use ($peminjaman) {
            $pengajuan = Peminjaman::whereKey($peminjaman->id)->lockForUpdate()->firstOrFail();

            if ((int) $pengajuan->user_id !== (int) Auth::id()) {
                abort(403);
            }

            if ($pengajuan->status !== Peminjaman::STATUS_PENDING) {
                return false;
            }

            $pengajuan->delete();

            return true;
        });

        if (! $dibatalkan) {
            return back()->with('error', 'Hanya pengajuan berstatus Pending yang dapat dibatalkan.');
        }

        return back()->with('success', 'Pengajuan berhasil dibatalkan.');
    }

    public function adminIndex(Request $request): View
    {
        $status = $this->statusFilter($request);

        $peminjamans = Peminjaman::with(['user', 'ruangan'])
    ->when($status, fn ($query) => $query->where('status', $status))
    ->orderBy('created_at', 'asc')
    ->orderBy('id', 'asc')
    ->paginate(10)
    ->withQueryString();

        $ringkasan = Peminjaman::selectRaw('status, COUNT(*) AS total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.peminjaman.index', compact('peminjamans', 'status', 'ringkasan'));
    }

    public function updateStatus(UpdateStatusPeminjamanRequest $request, Peminjaman $peminjaman): RedirectResponse
    {
        $status = $request->validated('status');

        $hasil = DB::transaction(function () use ($peminjaman, $status, $request) {
            // Kunci ruangan terlebih dahulu agar dua persetujuan untuk ruang yang sama terserialisasi.
            $ruangan = Ruangan::whereKey($peminjaman->ruangan_id)->lockForUpdate()->first();

            $pengajuan = Peminjaman::whereKey($peminjaman->id)->lockForUpdate()->firstOrFail();

            if ($pengajuan->status !== Peminjaman::STATUS_PENDING) {
                return 'processed';
            }

            if ($status === Peminjaman::STATUS_DISETUJUI) {
                if (! $ruangan || $ruangan->status !== Ruangan::STATUS_TERSEDIA) {
                    return 'unavailable';
                }

                $bentrok = Peminjaman::where('ruangan_id', $pengajuan->ruangan_id)
                    ->where('status', Peminjaman::STATUS_DISETUJUI)
                    ->where('id', '!=', $pengajuan->id)
                    ->where('tanggal_mulai', '<', $pengajuan->tanggal_selesai)
                    ->where('tanggal_selesai', '>', $pengajuan->tanggal_mulai)
                    ->exists();

                if ($bentrok) {
                    return 'conflict';
                }
            }

            $pengajuan->update([
                'status' => $status,
                'alasan_penolakan' => $status === Peminjaman::STATUS_DITOLAK
                    ? $request->validated('alasan_penolakan')
                    : null,
            ]);

            return 'updated';
        });

        if ($hasil === 'processed') {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        if ($hasil === 'conflict') {
            return back()->with('error', 'Jadwal bentrok dengan peminjaman lain yang sudah disetujui.');
        }

        if ($hasil === 'unavailable') {
            return back()->with('error', 'Ruangan sedang tidak tersedia sehingga pengajuan tidak dapat disetujui.');
        }

        return back()->with('success', "Pengajuan berhasil diubah menjadi {$status}.");
    }

    private function statusFilter(Request $request): ?string
    {
        $status = strtolower(trim((string) $request->query('status')));

        return match ($status) {
            'pending', 'menunggu' => Peminjaman::STATUS_PENDING,
            'disetujui' => Peminjaman::STATUS_DISETUJUI,
            'ditolak' => Peminjaman::STATUS_DITOLAK,
            default => null,
        };
    }
}