<?php

namespace App\Http\Resources\API\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $message
 */
class TokenResource extends JsonResource
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
            'token' => $this->resource->token,
            'user' => $this->resource->user,
        ];
    }
}
