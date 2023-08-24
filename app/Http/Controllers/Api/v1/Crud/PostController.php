<?php

namespace App\Http\Controllers\API\v1\Crud;

use App\DTOs\Post\PostCreateDTO;
use App\DTOs\Post\PostUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Post\PostCreateRequest;
use App\Http\Requests\Api\v1\Post\PostUpdateRequest;
use App\Http\Resources\Api\v1\Responces\SuccessDestroyResource;
use App\Services\Crud\PostService;
use App\Services\CrudService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class PostController extends Controller
{

    public function __construct(private readonly PostService $postService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function index()
    {
        $collection = $this->postService->getPosts();

        if ($collection->isEmpty()) {
            return CrudService::sendErrorResponse('No posts found');
        }

        return $this->postService::makeSuccessCollectionResponse('Success get collection of posts', $collection);
    }

    /**
     * Store a newly created resource in storage.
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function store(PostCreateRequest $request)
    {
        $dto = PostCreateDTO::fromRequest($request);
        try {
            $post = $this->postService->createPost($dto);
        } catch (\Exception $e) {
            return CrudService::sendErrorResponse('Error creating post', $e->getCode());
        }

        return $this->postService::makeSuccessResponse('Post created', $post);
    }

    /**
     * Display the specified resource.
     *
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function show(int $id)
    {
        try {
            $post = $this->postService->getPost($id);
        } catch (ModelNotFoundException) {
            return CrudService::sendErrorResponse("Post with id - {$id}  not found");
        } catch (\Exception $e) {
            return CrudService::sendErrorResponse('Error updating post', $e->getCode());
        }

        return $this->postService::makeSuccessResponse('Post showed', $post);
    }


    /**
     * Update the specified resource in storage.
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function update(PostUpdateRequest $request, int $id)
    {
        $data = PostUpdateDTO::fromRequest($request);

        try {
            $post = $this->postService->updatePost($id, $data);
        } catch (ModelNotFoundException) {
            return CrudService::sendErrorResponse("Post with id - {$id}  not found");
        } catch (\Exception $e) {
            return CrudService::sendErrorResponse('Error updating post', $e->getCode());
        }

        return $this->postService::makeSuccessResponse('Post updated', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->postService->deletePost($id);
        } catch (ModelNotFoundException) {
            return CrudService::sendErrorResponse("Post with id - {$id}  not found");
        } catch (\Exception $e) {
            return CrudService::sendErrorResponse('Error creating post', $e->getCode());
        }

        return CrudService::sendSuccessDeleteResponse("Post with id - {$id} successfully deleted");
    }
}
