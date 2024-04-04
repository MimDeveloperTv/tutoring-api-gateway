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

    public function operatorIndex(Request $request): JsonResponse
    {
        return $this->index($this->coreService->operatorIndex($request->toArray()));
    }

    public function operatorShow(string $id): JsonResponse
    {
        return $this->show($this->coreService->operatorShow($id));
    }

    public function operatorStore(Request $request): JsonResponse
    {
        return $this->store($this->coreService->operatorStore($request->toArray()));
    }

}
