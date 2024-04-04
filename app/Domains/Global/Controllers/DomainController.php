<?php

namespace App\Domains\Global\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class DomainController extends BaseController
{
    protected function store($data = []): JsonResponse
    {
        return response()->json($data, 200);
    }

    protected function update($data = []): JsonResponse
    {
        return response()->json($data, 200);
    }

    protected function index($data = []): JsonResponse
    {
        return response()->json($data, 200);
    }

    protected function show($data = []): JsonResponse
    {
        return response()->json($data, 200);
    }

    protected function delete($data = []): JsonResponse
    {
        return response()->json($data, 200);
    }
}
