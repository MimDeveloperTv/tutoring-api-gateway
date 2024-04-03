<?php

namespace App\Domains\Core\Contracts;

interface CoreContract
{
    public function index(array $data): mixed;
    public function show(string $id): mixed;

    public function store(array $data): mixed;
}
