<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|min:6|unique:users,username',
            'password' => 'required|min:8|confirmed'
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'username wajib di isi',
            'username.min' => 'username minimal 6',
            'username.unique' => 'username sudah dipakai',

            'password.required' => 'password wajib di isi',
            'password.min' => 'username minimal 8',
            'password.confirmed' => 'password tidak sama'
        ];
    }
}
