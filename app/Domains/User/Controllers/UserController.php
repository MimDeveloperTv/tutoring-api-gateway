<?php

namespace App\Domains\User\Controllers;

use App\Domains\User\Contracts\UserContract;
use App\Domains\Global\Controllers\DomainController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends DomainController
{
    public function __construct(
        private readonly UserContract $userService,
    )
    {
    }

    public function info(Request $request): JsonResponse
    {
        return $this->responseShow($this->userService->info($request->toArray()));
    }
}
