<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
        'remember' => ['sometimes', 'boolean'],
    ];
}

    public function messages(): array
    {
        return [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'role.in' => 'Kategori akun tidak valid.',
            'nim.required_if' => 'NIM wajib diisi.',
            'nim.regex' => 'NIM hanya boleh berisi angka.',
            'nip.required_if' => 'NIP wajib diisi.',
            'nip.regex' => 'NIP hanya boleh berisi angka.',
        ];
    }
}