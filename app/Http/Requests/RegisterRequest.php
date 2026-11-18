<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('email')) {
            $this->merge(['email' => strtolower(trim((string) $this->input('email')))]);
        }
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'min:3', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:' . User::PASSWORD_MIN, 'confirmed'],
            'role'     => ['required', 'in:mahasiswa,pengelola'],
            'nim'      => ['nullable', 'required_if:role,mahasiswa', 'regex:/^[0-9]+$/', 'max:20', 'unique:users,nim'],
            'nip'      => ['nullable', 'required_if:role,pengelola', 'regex:/^[0-9]+$/', 'max:30', 'unique:users,nip'],
            // Bila SIPLUS_KODE_PENGELOLA kosong, tidak ada kode yang lolos (aman secara bawaan)
            'kode_pengelola' => [
                'nullable',
                'required_if:role,pengelola',
                Rule::in([(string) config('siplus.kode_pengelola')]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Nama wajib diisi.',
            'name.min'           => 'Nama minimal 3 karakter.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal ' . User::PASSWORD_MIN . ' karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'role.required'      => 'Peran wajib dipilih.',
            'role.in'            => 'Peran harus mahasiswa atau pengelola.',
            'nim.required_if'    => 'NIM wajib diisi untuk mahasiswa.',
            'nim.regex'          => 'NIM hanya boleh berisi angka.',
            'nim.unique'         => 'NIM sudah terdaftar.',
            'nip.required_if'    => 'NIP wajib diisi untuk pengelola.',
            'nip.regex'          => 'NIP hanya boleh berisi angka.',
            'nip.unique'         => 'NIP sudah terdaftar.',
            'kode_pengelola.required_if' => 'Kode pengelola wajib diisi.',
            'kode_pengelola.in'          => 'Kode pengelola tidak valid.',
        ];
    }
}