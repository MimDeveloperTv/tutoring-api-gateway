<?php

namespace App\Domains\Global\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class DomainController extends BaseController
{
    protected function responseStore($data = []): JsonResponse
    {
        return response()->json($data, 200);
    }

    protected function responseUpdate($data = []): JsonResponse
    {
        return response()->json($data, 200);
    }

    protected function responseIndex($data = []): JsonResponse
    {
        return response()->json($data, 200);
    }

    protected function responseShow($data = []): JsonResponse
    {
        return response()->json($data, 200);
    }

    protected function responseDelete($data = []): JsonResponse
    {
        return response()->json($data, 200);
    }
}
