<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\DTOs\Auth\AuthResponseDTO;
use App\DTOs\Auth\LoginRequestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Auth\LoginRequest;
use App\Http\Resources\Api\v1\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class AuthController extends Controller
{
    /**
     * Login user into system.
     *
     * @param  LoginRequest  $request
     * @return JsonResponse
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $dto = LoginRequestDTO::fromRequest($request);

        /* @var AuthResponseDTO $attemptLogin */
        $responseDTO = AuthService::attemptLoginUser($dto);

        return AuthService::sendResponse($responseDTO);
    }

    /**
     * Login user into system.
     *
     * @param  Request  $request
     * @return UserResource
     */
    public function getUser(Request $request): UserResource
    {
        return new UserResource(auth()->user()->toArray());
    }

    /**
     * Login user into system.
     *
     * @return JsonResponse
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function refreshToken(): JsonResponse
    {
        $refreshed = AuthService::refreshUserTokens();

        return AuthService::sendResponse($refreshed);
    }

    /**
     * Login user into system.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $result = AuthService::logoutUser();
        return response()->json($result);
    }

}
