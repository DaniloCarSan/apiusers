<?php

namespace App\Http\Resources\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CredentialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => new UserResource($this->user),
            'accessToken'  => new AccessTokenResource($this->accessToken)
        ];
    }
}
