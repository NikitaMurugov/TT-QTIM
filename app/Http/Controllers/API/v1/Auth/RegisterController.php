<?php

namespace App\Http\Controllers\API\v1\Auth;

use App\DTOs\Auth\LoginRequestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\Auth\AuthService;
use WendellAdriel\ValidatedDTO\Exceptions\CastTargetException;
use WendellAdriel\ValidatedDTO\Exceptions\MissingCastTypeException;

class RegisterController extends Controller
{
    /**
     * Login user into system.
     *
     * @param  Request  $request
     * @return JsonResponse
     * @throws CastTargetException
     * @throws MissingCastTypeException
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::query()->create(array_merge(
            $data,
            ['password' => Hash::make($data['password'])]
        ));

        $dto = LoginRequestDTO::fromArray(array_merge(
            $user->toArray(),
            ['password' => $data['password']]
        ));

        $authUser = AuthService::attemptLoginUser($dto);

        return AuthService::sendResponse($authUser);
    }
}
