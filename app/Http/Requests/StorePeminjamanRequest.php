<?php

namespace App\Http\Requests;

use App\Models\Peminjaman;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StorePeminjamanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Hanya ruangan berstatus tersedia yang boleh dipinjam
            'ruangan_id'      => ['required', Rule::exists('ruangans', 'id')->where('status', Ruangan::STATUS_TERSEDIA)],
            'tanggal_mulai'   => ['required', 'date', 'after_or_equal:now'],
            'tanggal_selesai' => ['required', 'date', 'after:tanggal_mulai'],
            'keperluan'       => ['required', 'string', 'min:5', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'ruangan_id.required'          => 'Ruangan wajib dipilih.',
            'ruangan_id.exists'            => 'Ruangan tidak ditemukan atau sedang tidak tersedia.',
            'tanggal_mulai.required'       => 'Waktu mulai wajib diisi.',
            'tanggal_mulai.date'           => 'Format waktu mulai tidak valid.',
            'tanggal_mulai.after_or_equal' => 'Waktu mulai tidak boleh sebelum sekarang.',
            'tanggal_selesai.required'     => 'Waktu selesai wajib diisi.',
            'tanggal_selesai.after'        => 'Waktu selesai harus setelah waktu mulai.',
            'keperluan.required'           => 'Keperluan wajib diisi.',
            'keperluan.min'                => 'Keperluan minimal 5 karakter.',
        ];
    }

    /**
     * Pemeriksaan lanjutan setelah aturan dasar lolos:
     * satu hari, jam layanan, dan bentrok dengan peminjaman yang sudah disetujui.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->isNotEmpty()) {
                    return;
                }

                $mulai   = Carbon::parse($this->input('tanggal_mulai'));
                $selesai = Carbon::parse($this->input('tanggal_selesai'));

                if (! $mulai->isSameDay($selesai)) {
                    $validator->errors()->add('tanggal_selesai', 'Peminjaman harus selesai pada hari yang sama.');
                    return;
                }

                $jam  = config('siplus.jam_layanan');
                $hari = $mulai->dayOfWeek;

                if (! isset($jam[$hari])) {
                    $validator->errors()->add('tanggal_mulai', 'Layanan peminjaman tutup pada hari tersebut.');
                    return;
                }

                [$buka, $tutup] = $jam[$hari];

                if ($mulai->lt($mulai->copy()->setTimeFromTimeString($buka))
                    || $selesai->gt($selesai->copy()->setTimeFromTimeString($tutup))) {
                    $validator->errors()->add('tanggal_mulai', "Peminjaman harus berada dalam jam layanan {$buka} - {$tutup} WIB.");
                    return;
                }

                $bentrok = Peminjaman::where('ruangan_id', $this->input('ruangan_id'))
                    ->where('status', Peminjaman::STATUS_DISETUJUI)
                    ->where('tanggal_mulai', '<', $selesai)
                    ->where('tanggal_selesai', '>', $mulai)
                    ->exists();

                if ($bentrok) {
                    $validator->errors()->add('ruangan_id', 'Ruangan sudah dipesan pada waktu tersebut.');
                }
            },
        ];
    }
}