<?php

namespace App\Http\Resources\Api\v1\Post;

use App\DTOs\Post\PostsResponseDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsCollectionResource extends JsonResource
{

    public function __construct(PostsResponseDTO $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        /* @var PostsResponseDTO $this*/
        return [
            'success' => $this->success,
            'message' => $this->message,
            'data' => $this->collection,
        ];
    }
}
