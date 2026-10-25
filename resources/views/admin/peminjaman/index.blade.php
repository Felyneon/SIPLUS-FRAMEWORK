<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Persetujuan Peminjaman Ruangan SIPLUS</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #1e3a8a; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .btn-setuju { background-color: #22c55e; color: white; border: none; padding: 6px 12px; cursor: pointer; border-radius: 4px; }
        .btn-tolak { background-color: #ef4444; color: white; border: none; padding: 6px 12px; cursor: pointer; border-radius: 4px; }
        .badge-pending { color: #d97706; font-weight: bold; }
        .badge-disetujui { color: #16a34a; font-weight: bold; }
        .badge-ditolak { color: #dc2626; font-weight: bold; }
        .alert-success { color: green; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>

    <h1>Panel Admin: Daftar Pengajuan Peminjaman Ruangan</h1>
    <p><a href="/dashboard">← Kembali ke Dashboard</a></p>

    {{-- Pesan Sukses jika status berhasil diubah --}}
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Nama Ruangan</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Keperluan</th>
                <th>Status</th>
                <th>Aksi / Persetujuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    {{-- Mengambil data nama user dan ruangan melalui relasi Eloquent Model --}}
                    <td>{{ $p->user->name ?? 'User Tidak Ditemukan' }}</td>
                    <td>{{ $p->ruangan->nama_ruangan ?? 'Ruangan Tidak Ditemukan' }}</td>
                    <td>{{ $p->tanggal_mulai }}</td>
                    <td>{{ $p->tanggal_selesai }}</td>
                    <td>{{ $p->keperluan }}</td>
                    <td>
                        <span class="
                            @if($p->status == 'Pending') badge-pending 
                            @elseif($p->status == 'Disetujui') badge-disetujui 
                            @else badge-ditolak 
                            @endif">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td>
                        {{-- Form untuk menyetujui peminjaman --}}
                        <form action="/admin/peminjaman/{{ $p->id }}/status" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="status" value="Disetujui">
                            <button type="submit" class="btn-setuju" onclick="return confirm('Setujui peminjaman ini?')">Setuju</button>
                        </form>

                        {{-- Form untuk menolak peminjaman --}}
                        <form action="/admin/peminjaman/{{ $p->id }}/status" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="status" value="Ditolak">
                            <button type="submit" class="btn-tolak" onclick="return confirm('Tolak peminjaman ini?')">Tolak</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center;">Belum ada pengajuan peminjaman ruangan yang masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>