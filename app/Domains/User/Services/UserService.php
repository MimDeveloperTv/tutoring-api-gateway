<?php

namespace App\Domains\User\Services;

use App\Domains\Global\Exceptions\DomainException;
use App\Domains\Global\Services\GlobalService;
use App\Domains\User\Contracts\UserContract;

class UserService extends GlobalService implements UserContract
{
    public const CONFIG = 'user';
    /**
     * WalletService constructor.
     */
    public function __construct()
    {
        parent::__construct(self::CONFIG);
    }

    /**  @throws DomainException */
    public function info(array $data): mixed
    {
        return $this->get("user/info", $data);
    }
}
