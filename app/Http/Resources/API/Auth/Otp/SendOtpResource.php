<?php

namespace App\Http\Resources\API\Auth\Otp;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $message
 */
class SendOtpResource extends JsonResource
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
            'message' => $this->resource->message,
        ];
    }
}
