<?php

namespace App\Domains\Card\Controllers;

use App\Domains\Card\Contracts\CardContract;
use App\Domains\Global\Controllers\DomainController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardController extends DomainController
{
    public function __construct(
        private readonly CardContract $cardService,
    )
    {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->responseIndex($this->cardService->index($request->toArray()));
    }

    public function show(string $id): JsonResponse
    {
        return $this->responseShow($this->cardService->show($id));
    }

    public function store(Request $request): JsonResponse
    {
        return $this->responseStore($this->cardService->store($request->toArray()));
    }
}
