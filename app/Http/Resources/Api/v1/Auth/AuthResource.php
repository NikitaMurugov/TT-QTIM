<?php

namespace App\Http\Resources\Api\v1\Auth;

use App\DTOs\Auth\AuthResponseDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        /** @var AuthResponseDTO $this */
        return $this->success
            ? [
                'token' => $this->token,
                'token_type' => $this->token_type,
                'success' => $this->success,
                'message' => $this->message,
            ] : [
                'success' => $this->success,
                'message' => $this->message,
            ];
    }
}
