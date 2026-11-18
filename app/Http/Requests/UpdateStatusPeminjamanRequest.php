<?php

namespace App\Http\Requests;

use App\Models\Peminjaman;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateStatusPeminjamanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;   // dijaga middleware isAdministrator
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in([Peminjaman::STATUS_DISETUJUI, Peminjaman::STATUS_DITOLAK])],
            'alasan_penolakan' => ['nullable', 'required_if:status,' . Peminjaman::STATUS_DITOLAK, 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status wajib dipilih.',
            'status.in'       => 'Status harus Disetujui atau Ditolak.',
            'alasan_penolakan.required_if' => 'Alasan penolakan wajib diisi bila pengajuan ditolak.',
            'alasan_penolakan.max'         => 'Alasan penolakan maksimal 500 karakter.',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->isNotEmpty()) {
                    return;
                }

                /** @var Peminjaman $peminjaman */
                $peminjaman = $this->route('peminjaman');

                if ($peminjaman->status !== Peminjaman::STATUS_PENDING) {
                    $validator->errors()->add('status', 'Pengajuan ini sudah diproses sebelumnya.');
                    return;
                }

                if ($this->input('status') === Peminjaman::STATUS_DISETUJUI) {
                    $bentrok = Peminjaman::where('ruangan_id', $peminjaman->ruangan_id)
                        ->where('status', Peminjaman::STATUS_DISETUJUI)
                        ->where('id', '!=', $peminjaman->id)
                        ->where('tanggal_mulai', '<', $peminjaman->tanggal_selesai)
                        ->where('tanggal_selesai', '>', $peminjaman->tanggal_mulai)
                        ->exists();

                    if ($bentrok) {
                        $validator->errors()->add('status', 'Jadwal bentrok dengan peminjaman lain yang sudah disetujui.');
                    }
                }
            },
        ];
    }
}