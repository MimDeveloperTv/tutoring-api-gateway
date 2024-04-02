<?php

namespace App\Http\Resources\API\Auth\Basic;

use App\Enum\GrantType;
use App\Enum\UserGroup;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $message
 */
class ValidateTokenResource extends JsonResource
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
            'message' => 'Your Token Validate successfully',
            'client_id' => data_get($this->resource->token, 'client_id'),
            'grant_type' => GrantType::format(GrantType::BASIC),
            'user' => [
                'id' => data_get($this->resource->user, 'id'),
                'phone' => data_get($this->resource->user, 'phone'),
                'email' => data_get($this->resource->user, 'email'),
                'first_name' => data_get($this->resource->user, 'first_name'),
                'last_name' => data_get($this->resource->user, 'last_name'),
                'fullname' => data_get($this->resource->user, 'first_name') .
                              data_get($this->resource->user, 'last_name'),
                'avatar' => data_get($this->resource->user, 'avatar'),
                'group' => UserGroup::format(data_get($this->resource->client, 'name')),
            ]
        ];
    }
}
