<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;   // dijaga middleware isAdministrator
    }

    public function rules(): array
    {
        return [
            'role_id' => ['required', Rule::in([Role::PENGELOLA, Role::MAHASISWA])],
        ];
    }

    public function messages(): array
    {
        return [
            'role_id.required' => 'Peran wajib dipilih.',
            'role_id.in'       => 'Peran tidak valid.',
        ];
    }
}