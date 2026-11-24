<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Pengguna hanya boleh mengubah profil miliknya sendiri.
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'username' => is_string($this->input('username'))
                ? strtolower(trim($this->input('username')))
                : $this->input('username'),
            'name' => is_string($this->input('name'))
                ? trim($this->input('name'))
                : $this->input('name'),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'regex:/^[a-zA-Z0-9._-]+$/',
                Rule::unique('users', 'username')->ignore($this->user()->id),
            ],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.max' => 'Username maksimal 30 karakter.',
            'username.regex' => 'Username hanya boleh berisi huruf, angka, titik, garis bawah, dan tanda hubung.',
            'username.unique' => 'Username sudah digunakan pengguna lain.',
            'profile_image.image' => 'File yang diunggah harus berupa gambar.',
            'profile_image.mimes' => 'Foto profil harus berformat JPG, JPEG, PNG, atau WEBP.',
            'profile_image.max' => 'Ukuran foto profil maksimal 2 MB.',
        ];
    }
}
