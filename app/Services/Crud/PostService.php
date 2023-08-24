<?php

namespace App\Services\Crud;

use App\DTOs\Post\PostCreateDTO;
use App\DTOs\Post\PostResponseDTO;
use App\DTOs\Post\PostsResponseDTO;
use App\DTOs\Post\PostUpdateDTO;
use App\Http\Resources\Api\v1\Post\PostCollectionResource;
use App\Http\Resources\Api\v1\Post\PostResource;
use App\Http\Resources\Api\v1\Post\PostsCollectionResource;
use App\Http\Resources\Api\v1\Responces\SuccessDestroyResource;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Services\CrudService;
use Illuminate\Database\Eloquent\Collection;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class PostService
{
    public function __construct(private readonly PostRepository $postRepository)
    {
    }

    /**
     * @return Post[]|Collection<Post>|array
     */
    public function getPosts(): array|Collection
    {
        return $this->postRepository->getAll();
    }

    /**
     * @param  int  $id
     * @return Post|null
     */
    public function getPost(int $id): ?Post
    {
        return $this->postRepository->findById($id);
    }

    /**
     *
     * @param  int  $id
     * @param  PostUpdateDTO  $data
     * @return Post|null
     */
    public function updatePost(int $id, PostUpdateDTO $data): ?Post
    {
        return $this->postRepository->updateById($id, $data);
    }

    /**
     * @param  PostCreateDTO  $id
     * @return Post|null
     */
    public function createPost(PostCreateDTO $data): ?Post
    {
        return $this->postRepository->create($data);
    }
    /**
     * @param  int $id
     * @return bool
     */
    public function deletePost(int $id): bool
    {
        return $this->postRepository->deleteById($id);
    }

    /**
     * @param  string  $message
     * @param  Post  $post
     * @param  int  $code
     * @return PostCollectionResource
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public static function makeSuccessResponse(string $message, Post $post, int $code = 200): PostCollectionResource
    {
        $resourceDTO = PostResponseDTO::fromArray([
            'success' => true,
            'message' => $message,
            'post' => new PostResource($post)
        ]);

        return new PostCollectionResource($resourceDTO);
    }

    /**
     * @param  string  $message
     * @param  Collection  $posts
     * @param  int  $code
     * @return PostsCollectionResource
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public static function makeSuccessCollectionResponse(string $message, Collection $posts,int $code = 200): PostsCollectionResource
    {
        $resourceDTO = PostsResponseDTO::fromArray([
            'success' => true,
            'message' => $message,
            'collection' => PostResource::collection($posts)
        ]);

        return new PostsCollectionResource($resourceDTO);
    }

    /**
     * @param  string  $message
     * @return SuccessDestroyResource
     */
    public static function makeSuccessDeleteResponse(string $message): SuccessDestroyResource
    {
        return new SuccessDestroyResource($message);
    }
}
