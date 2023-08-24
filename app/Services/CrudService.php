<?php

namespace App\Services;

use App\DTOs\MessageResponseDTO;
use App\Http\Resources\Api\v1\Responces\MessageResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class CrudService
{
    /**
     * @param  string  $message
     * @param  int  $code
     *
     * @return JsonResponse
     *
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public static function sendErrorResponse(
        string $message = 'Error',
        int $code = Response::HTTP_NOT_FOUND
    ): JsonResponse
    {
        $dto = MessageResponseDTO::fromArray([
            'success' => false,
            'message' => $message
        ]);
        return (new MessageResource($dto))
            ->response()
            ->setStatusCode($code);
    }

    /**
     * @param  string  $message
     * @param  int  $code
     *
     * @return JsonResponse
     *
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public static function sendSuccessDeleteResponse(
        string $message = 'Success delete resource',
        int $code = Response::HTTP_OK
    ): JsonResponse
    {
        $dto = MessageResponseDTO::fromArray([
            'success' => true,
            'message' => $message
        ]);
        return (new MessageResource($dto))
            ->response()
            ->setStatusCode($code);
    }
}
