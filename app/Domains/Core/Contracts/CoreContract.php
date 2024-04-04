<?php

namespace App\Domains\Core\Contracts;

interface CoreContract
{
    public function operatorIndex(array $data): mixed;
    public function operatorShow(string $id): mixed;
    public function operatorStore(array $data): mixed;
}
