<?php

namespace App\Http\Requests;

use App\Models\Ruangan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RuanganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;   // hak akses dijaga middleware isAdministrator pada route
    }

    public function rules(): array
    {
        return [
            // Pada route update, route('ruangan') berisi Model yang sedang diubah (dikecualikan dari unique)
            'kode_ruang'   => ['required', 'string', 'max:20',
                               Rule::unique('ruangans', 'kode_ruang')->ignore($this->route('ruangan'))],
            'nama_ruangan' => ['required', 'string', 'min:3', 'max:255'],
            'kapasitas'    => ['required', 'integer', 'min:1', 'max:5000'],
            'lokasi'       => ['required', 'string', 'max:255'],
            'deskripsi'    => ['nullable', 'string', 'max:1000'],
            'status'       => ['required', Rule::in(array_keys(Ruangan::STATUS))],
        ];
    }

    public function messages(): array
    {
        return [
            'kode_ruang.required'   => 'Kode ruangan wajib diisi.',
            'kode_ruang.unique'     => 'Kode ruangan sudah terdaftar.',
            'kode_ruang.max'        => 'Kode ruangan maksimal 20 karakter.',
            'nama_ruangan.required' => 'Nama ruangan wajib diisi.',
            'nama_ruangan.min'      => 'Nama ruangan minimal 3 karakter.',
            'kapasitas.required'    => 'Kapasitas wajib diisi.',
            'kapasitas.integer'     => 'Kapasitas harus berupa angka.',
            'kapasitas.min'         => 'Kapasitas minimal 1 orang.',
            'kapasitas.max'         => 'Kapasitas maksimal 5000 orang.',
            'lokasi.required'       => 'Lokasi wajib diisi.',
            'status.required'       => 'Status ruangan wajib dipilih.',
            'status.in'             => 'Status ruangan tidak valid.',
        ];
    }
}