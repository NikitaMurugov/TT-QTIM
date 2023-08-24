<?php

namespace App\DTOs\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class PostsResponseDTO extends ValidatedDTO
{

    public bool $success;
    public string|null $message;
    public Collection|AnonymousResourceCollection|Post $collection;
    /**
     * Defines the validation rules for the DTO.
     */
    protected function rules(): array
    {
        return [
            'success' => ['nullable'],
            'message' => ['nullable', 'string'],
            'collection' => ['required'],
        ];
    }

    /**
     * Defines the default values for the properties of the DTO.
     */
    protected function defaults(): array
    {
        return [
            'success' => true,
            'message' => 'Success',
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
