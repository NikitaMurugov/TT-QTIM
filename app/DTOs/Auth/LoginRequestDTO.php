<?php

namespace App\DTOs\Auth;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class LoginRequestDTO extends ValidatedDTO
{
    public string $email;
    public string $password;
    public bool $remember_me;

    /**
     * Defines the validation rules for the DTO.
     */
    protected function rules(): array
    {
        return [
            'email' => ['required', 'exists:users,email', 'email', 'min:6', 'max:255'],
            'password' => ['required', 'min:6', 'max:255'],
        ];
    }

    /**
     * Defines the default values for the properties of the DTO.
     */
    protected function defaults(): array
    {
        return [
            'remember_me' => false
        ];
    }

    protected function casts(): array
    {
        return [];
    }
}
