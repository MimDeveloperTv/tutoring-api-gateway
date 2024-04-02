<?php

namespace App\Domains\Card\Contracts;

interface CardContract
{
    public function index(array $data): mixed;
    public function show(string $id): mixed;
    public function store(array $data): mixed;
}
