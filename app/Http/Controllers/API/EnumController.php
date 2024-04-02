<?php

namespace App\Http\Controllers\API;

use App\Core\Enum\Manager;
use App\Enum\Gender;
use App\Enum\LookupAction;
use App\Enum\UserGroup;
use App\Enum\UserPurview;
use App\Enum\UserStatus;
use App\Http\Controllers\API\Auth\BaseController;
use Illuminate\Http\JsonResponse;


class EnumController extends BaseController
{
    public function enums(): JsonResponse
    {
        return response()->json([
            'data' => [
                'genders' => Manager::mapper(Gender::VALUES),
                'actions' => Manager::mapper(LookupAction::VALUES),
                'user_statuses' => Manager::mapper(UserStatus::VALUES),
                'user_groups' => Manager::mapper(UserGroup::VALUES),
                'user_purviews' =>  Manager::mapper(UserPurview::VALUES),
            ]
        ]);
    }

}
