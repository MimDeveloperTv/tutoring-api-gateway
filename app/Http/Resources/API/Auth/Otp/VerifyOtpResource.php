<?php

namespace App\Http\Resources\API\Auth\Otp;

use App\Enum\Field;
use App\Enum\UserPurview;
use App\Enum\UserStatus;
use App\Http\Resources\API\Auth\Pass\TokenResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $message
 */
class VerifyOtpResource extends JsonResource
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
            Field::MESSAGE => $this->resource->message,
            Field::USER_PURVIEW => UserPurview::format($this->resource->user_purview),
            Field::USER_STATUS => UserStatus::format(data_get($this->resource->user,'status.id')),
            Field::OTP => [
                Field::IS_NEED_CHALLENGE => $this->resource->is_need_challenge,
                Field::VERIFY_CHALLENGE => $this->resource->verify_challenge,
            ]
        ];

    }
}
