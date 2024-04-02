<?php

namespace App\Http\Resources\API\Auth;

use App\Enum\GrantType;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $message
 */
class LogoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) //phpcs:ignore
    {
        return [
            'message' => 'You have been successfully logged out!',
            'grant_type' => GrantType::format(GrantType::PASSWORD),
        ];
    }
}
