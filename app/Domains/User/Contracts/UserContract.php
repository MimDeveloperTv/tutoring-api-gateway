<?php

namespace App\Domains\User\Contracts;

interface UserContract
{
    public function info(array $data): mixed;
}
