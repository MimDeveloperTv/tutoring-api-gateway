<?php

namespace App\Domains\Card\Services;

use App\Domains\Global\Exceptions\DomainException;
use App\Domains\Global\Services\GlobalService;
use App\Domains\Card\Contracts\CardContract;

class CardService extends GlobalService implements CardContract
{
    public const CONFIG = 'card';
    /**
     * WalletService constructor.
     */
    public function __construct()
    {
        parent::__construct(self::CONFIG);
    }

    /**  @throws DomainException */
    public function index(array $data): mixed
    {
        return $this->get("cards", $data);
    }

    /**  @throws DomainException */
    public function show(string $id): mixed
    {
        return $this->get("cards/{$id}", []);
    }

    /**  @throws DomainException */
    public function store(array $data): mixed
    {
        return $this->post("cards", $data);
    }
}
