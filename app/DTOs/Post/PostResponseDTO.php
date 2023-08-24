<?php

namespace App\DTOs\Post;

use App\Http\Resources\Api\v1\Post\PostResource;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use WendellAdriel\ValidatedDTO\ValidatedDTO;

class PostResponseDTO extends ValidatedDTO
{

    public bool $success;
    public string|null $message;
    public PostResource $post;
    /**
     * Defines the validation rules for the DTO.
     */
    protected function rules(): array
    {
        return [
            'success' => ['nullable'],
            'message' => ['nullable', 'string'],
            'post' => ['required'],
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
