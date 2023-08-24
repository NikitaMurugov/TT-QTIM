<?php

namespace App\Http\Requests\API\v1\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'exists:users,email', 'email', 'min:6', 'max:255'],
            'password' => ['required', 'min:6', 'max:255'],
            'remember_me' => ['nullable', 'boolean'],
        ];
    }
}
