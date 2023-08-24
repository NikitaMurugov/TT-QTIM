<?php

namespace App\Repositories;


use App\DTOs\Post\CreatePostDTO;
use App\DTOs\Post\PostCreateDTO;
use App\DTOs\Post\PostUpdateDTO;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PostRepository
{
    private Builder $query;
    public function __construct()
    {
        $this->query = Post::query();
    }

    /**
     * @return Post[]|Collection|array
     */
    public function getAll(): Collection|array
    {
        return $this->query->get();
    }

    /**
     * @param  int  $id
     * @return Post|null
     */
    public function findById(int $id): Post|null
    {
        return $this->query->findOrFail($id);
    }

    /**
     * @param  PostCreateDTO  $data
     * @return Post|null
     */
    public function create(PostCreateDTO $data): Post|null
    {
        return $this->query->create($data->toArray());
    }

    /**
     * @param  int  $id
     * @param  PostUpdateDTO  $data
     *
     * @return Post
     */
    public function updateById(int $id, PostUpdateDTO $data): Post
    {
        $model = $this->query->findOrFail($id);
        $model->update($data->toArray());
        return $model->refresh();
    }

    public function deleteById(int $id): bool
    {
        $model = $this->query->findOrFail($id);
        return $model->delete();
    }
}
