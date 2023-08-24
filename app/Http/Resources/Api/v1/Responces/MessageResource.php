<?php

namespace App\Http\Resources\Api\v1\Responces;

use App\DTOs\MessageResponseDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{

    public function __construct(MessageResponseDTO $resource)
    {
        parent::__construct($resource);
    }

    public static $wrap = null;
    public function toArray(Request $request): array
    {
        /* @var MessageResponseDTO $this*/
        return [
            'success' => $this->success,
            'message' => $this->message,
        ];
    }
}
