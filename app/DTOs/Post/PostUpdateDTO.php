<?php

namespace App\DTOs\Post;

use WendellAdriel\ValidatedDTO\ValidatedDTO;

class PostUpdateDTO extends ValidatedDTO
{

    public string $title;
    public string $body;
    /**
     * Defines the validation rules for the DTO.
     */
    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'body' => ['required', 'string', 'min:3', 'max:60000'],
        ];
    }

    /**
     * Defines the default values for the properties of the DTO.
     */
    protected function defaults(): array
    {
        return [];
    }

    /**
     * Defines the type casting for the properties of the DTO.
     */
    protected function casts(): array
    {
        return [];
    }

}
