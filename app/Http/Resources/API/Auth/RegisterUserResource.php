<?php

namespace App\Http\Resources\API\Auth;

use App\Enum\Field;
use App\Enum\UserGroup;
use App\Enum\UserPurview;
use App\Enum\UserStatus;
use App\Http\Resources\API\Auth\Pass\TokenResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $message
 */
class RegisterUserResource extends JsonResource
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
            Field::IS_REGISTERED => $this->resource->operation->{Field::IS_REGISTERED},
            Field::USER_STATUS =>  UserStatus::format($this->resource->operation->{Field::USER_STATUS}),
            Field::USER_GROUP => UserGroup::format($this->resource->operation->{Field::USER_GROUP}),
            Field::MESSAGE => 'Your Request Operation Success',
            Field::TOKEN => $this->resource->token,
        ];

    }
}
