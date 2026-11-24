<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => strtolower(trim((string) $this->input('email'))),
            'nomor_identitas' => strtoupper(
                trim((string) $this->input('nomor_identitas'))
            ),
        ]);
    }

    /**
     * Aturan validasi utama registrasi.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:' . User::PASSWORD_MIN,
                'confirmed',
            ],

            'role' => [
                'required',
                'in:mahasiswa,pengelola',
            ],

            'jenis_identitas' => [
                'required',
                'in:nim,nip',
            ],

            'nomor_identitas' => [
                'required',
                'string',
                'max:30',
                'regex:/^[0-9]+$/',
                'unique:users,nomor_identitas',
            ],

            // Kode khusus untuk registrasi pengelola.
            'kode_pengelola' => [
                'nullable',
                'required_if:role,pengelola',
                Rule::in([
                    (string) config('siplus.kode_pengelola')
                ]),
            ],
        ];
    }

    /**
     * Validasi tambahan berdasarkan role pengguna.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $role = $this->input('role');
            $jenis = $this->input('jenis_identitas');

            // Mahasiswa wajib menggunakan NIM.
            if ($role === 'mahasiswa' && $jenis !== 'nim') {
                $validator->errors()->add(
                    'jenis_identitas',
                    'Mahasiswa wajib menggunakan NIM.'
                );
            }
        });
    }

    /**
     * Pesan kesalahan validasi.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal ' .
                User::PASSWORD_MIN . ' karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',

            'role.required' => 'Peran wajib dipilih.',
            'role.in' => 'Peran harus mahasiswa atau pengelola.',

            'jenis_identitas.required' =>
                'Jenis identitas wajib dipilih.',
            'jenis_identitas.in' =>
                'Jenis identitas harus NIM atau NIP.',

            'nomor_identitas.required' =>
                'Nomor identitas wajib diisi.',
            'nomor_identitas.regex' =>
                'Nomor identitas hanya boleh berisi angka.',
            'nomor_identitas.max' =>
                'Nomor identitas maksimal 30 karakter.',
            'nomor_identitas.unique' =>
                'Nomor identitas sudah terdaftar.',

            'kode_pengelola.required_if' =>
                'Kode pengelola wajib diisi.',
            'kode_pengelola.in' =>
                'Kode pengelola tidak valid.',
        ];
    }
}
