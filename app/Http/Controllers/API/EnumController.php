<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Auth\BaseController;
use Illuminate\Http\JsonResponse;


class EnumController extends BaseController
{
    public function enums(): JsonResponse
    {
        return response()->json([ 'data' => [] ]);
    }

}
