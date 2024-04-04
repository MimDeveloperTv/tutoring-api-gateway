<?php

namespace App\Domains\Core\Services;

use App\Domains\Global\Exceptions\DomainException;
use App\Domains\Global\Services\GlobalService;
use App\Domains\Core\Contracts\CoreContract;

class CoreService extends GlobalService implements CoreContract
{
    public const CONFIG = 'core';
    /**
     * WalletService constructor.
     */
    public function __construct()
    {
        parent::__construct(self::CONFIG);
    }

    /**  @throws DomainException */
    public function operatorIndex(array $data): mixed
    {
        return $this->get("operators", $data);
    }

    /**  @throws DomainException */
    public function operatorShow(string $id): mixed
    {
        return $this->get("operators/{$id}", []);
    }

    /**  @throws DomainException */
    public function operatorStore(array $data): mixed
    {
        return $this->post("operators", $data);
    }
}
