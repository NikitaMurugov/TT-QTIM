<?php

namespace App\Services\Auth;

use App\DTOs\Auth\AuthResponseDTO;
use App\DTOs\Auth\LoginRequestDTO;
use App\Http\Resources\Api\v1\Auth\AuthResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;
use WendellAdriel\ValidatedDTO\SimpleDTO;

class AuthService
{
    /**
     * @param  LoginRequestDTO  $dto
     * @return AuthResponseDTO|SimpleDTO
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public static function attemptLoginUser(LoginRequestDTO $dto): AuthResponseDTO|SimpleDTO
    {
        $credentials = [
            'email' => $dto->email,
            'password' => $dto->password,
        ];
        $attempt = auth()->attempt($credentials, $dto->remember_me);

        if (!$attempt) {
            return AuthResponseDTO::fromArray([
                'success' => false,
                'message' => 'Unsuccessful login, try again!',
            ]);
        }
        /* @var User $user */
        $user = auth()->user();
        $token = $user->createToken('remember_token');

        return AuthResponseDTO::fromArray([
            'token' => $token->plainTextToken,
            'success' => true,
            'message' => "Successful login! Welcome, {$user->name}!",
        ]);
    }

    /**
     * @return AuthResponseDTO|SimpleDTO
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public static function refreshUserTokens(): AuthResponseDTO|SimpleDTO
    {
        $user = auth()->user();

        $user->tokens()->delete();

        return AuthResponseDTO::fromArray([
            'token' => $user->createToken('remember_token')->plainTextToken,
            'success' => true,
            'message' => "Successful refresh tokens!",
        ]);
    }

    /**
     * @return JsonResponse
     */
    public static function logoutUser(): array
    {
        auth()->user()->tokens()->delete();

        return [
            'success' => true,
            'message' => 'success logout!',
        ];
    }

    /**
     * @param  AuthResponseDTO  $responseDTO
     * @return JsonResponse
     */
    public static function sendResponse(AuthResponseDTO $responseDTO): JsonResponse
    {
        $statusCode = $responseDTO->success ? Response::HTTP_OK : Response::HTTP_UNAUTHORIZED;
        return (new AuthResource($responseDTO))
            ->response()
            ->setStatusCode($statusCode);
    }
}
