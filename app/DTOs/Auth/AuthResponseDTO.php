<?php

namespace App\DTOs\Auth;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class AuthResponseDTO extends ValidatedDTO
{
    public string|null $token;
    public bool $success;
    public string|null $token_type;
    public string|null $message;

    /**
     * Defines the validation rules for the DTO.
     */
    protected function rules(): array
    {
        return [
            'token' => ['nullable', 'string'],
            'success' => ['nullable', 'boolean'],
            'token_type' => ['nullable', 'string'],
            'message' => ['nullable', 'string'],
        ];
    }

    /**
     * Defines the default values for the properties of the DTO.
     */
    protected function defaults(): array
    {
        return [
            'success' => false,
            'token_type' => 'Bearer',
            'message' => 'Successful',
        ];
    }

    /**
     * Defines the type casting for the properties of the DTO.
     */
    protected function casts(): array
    {
        return [];
    }

}
