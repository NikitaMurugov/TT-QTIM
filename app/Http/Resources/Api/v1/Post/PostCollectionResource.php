<?php

namespace App\Http\Resources\Api\v1\Post;

use App\DTOs\Post\PostResponseDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCollectionResource extends JsonResource
{

    public function __construct(PostResponseDTO $resource)
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
        /* @var PostResponseDTO $this*/
        return [
            'success' => $this->success,
            'message' => $this->message,
            'data' => $this->post,
        ];
    }
}
