<?php

namespace App\Http\Resources\API\Auth\Lookup;

use App\Enum\Field;
use App\Enum\GrantType;
use App\Enum\LookupAction as Action;
use App\Enum\UserGroup;
use App\Enum\UserStatus;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $message
 */
class LookupResource extends JsonResource
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
            Field::ACTION => Action::format($this->resource->action),
            Field::IS_USER => $this->resource->is_user,
            Field::IS_MEMBER_GROUP => $this->resource->is_member_group,
        ];
    }
}
