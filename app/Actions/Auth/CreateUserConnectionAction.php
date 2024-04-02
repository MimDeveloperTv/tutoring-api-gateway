<?php

namespace App\Actions\Auth;

use Lorisleiva\Actions\Concerns\AsAction;
use Symfony\Component\Uid\Ulid;

class CreateUserConnectionAction
{
    use AsAction;

    /**
     */
    public function handle(array $connection): string
    {
        $name = Ulid::generate();
        $cnf = array_merge(config("database.connections.mysql"), [
            'host' => $connection['host'],
            'database' => $connection['database'],
            'username' => $connection['username'],
            'password' => $connection['password'],
        ]);

        config(["database.connections.{$name}" => $cnf]);
        request()->merge(['connection' => $name]);
        return $name;
    }
}
