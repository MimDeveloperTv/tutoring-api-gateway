<?php

namespace App\Domains\Core\Controllers;

use App\Domains\Core\Contracts\CoreContract;
use App\Domains\Global\Controllers\DomainController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CoreController extends DomainController
{
    public function __construct(
        private readonly CoreContract $coreService,
    )
    {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->responseIndex($this->coreService->index($request->toArray()));
    }

    public function show(string $id): JsonResponse
    {
        return $this->responseShow($this->coreService->show($id));
    }

    public function store(Request $request): JsonResponse
    {
        return $this->responseStore($this->coreService->store($request->toArray()));
    }

}
