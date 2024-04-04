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

    /**  @throws DomainException */
    public function personnelIndex(array $data): mixed
    {
        return $this->get("personnel", $data);
    }

    /**  @throws DomainException */
    public function personnelShow(string $id): mixed
    {
        return $this->get("personnel/{$id}", []);
    }


    /**  @throws DomainException */
    public function patientIndex(array $data): mixed
    {
        return $this->get("patients", $data);
    }

    /**  @throws DomainException */
    public function patientShow(string $id): mixed
    {
        return $this->get("patients/{$id}", []);
    }

    /**  @throws DomainException */
    public function patientStore(array $data): mixed
    {
        return $this->post("patients", $data);
    }



    /**  @throws DomainException */
    public function userPatientShow(string $id): mixed
    {
        return $this->get("user/{$id}/patient", []);
    }

    /**  @throws DomainException */
    public function userPatientStore(string $id,array $data): mixed
    {
        return $this->post("user/{$id}/patient", $data);
    }

    /**  @throws DomainException */
    public function userOperatorShow(string $id): mixed
    {
        return $this->get("user/{$id}/operator", []);
    }

    /**  @throws DomainException */
    public function userOperatorStore(string $id,array $data): mixed
    {
        return $this->post("user/{$id}/operator", $data);
    }



    /**  @throws DomainException */
    public function appointmentIndex(array $data): mixed
    {
        return $this->get("appointments", $data);
    }

    /**  @throws DomainException */
    public function appointmentStatusUpdate(string $id,array $data): mixed
    {
        return $this->patch("appointments/{$id}/status", $data);
    }

    /**  @throws DomainException */
    public function appointmentPaymentStatusUpdate(string $id,array $data): mixed
    {
        return $this->patch("appointments/{$id}/payment-status", $data);
    }
}
