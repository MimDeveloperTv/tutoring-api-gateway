<?php

namespace App\Core\Transporter;
use App\Enum\Method;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\PendingRequest;
use JustSteveKing\Transporter\Request as TransporterRequest;

abstract class BaseRequest extends TransporterRequest
{
    public const NAME = 'base-request';
    protected string $method = Method::GET;
    protected string $path;
    protected array $data = [];
    protected string $domain;

    public function __construct(HttpFactory $http)
    {
        parent::__construct($http);
        $this->setBaseUrl($this->loadBaseUrl());
    }

    protected function withRequest(PendingRequest $request): void
    {
        $request->withHeaders([
            'X-CLIENT-CREDENTIAL' => config('services.credentials.client'),
            'ACCEPT' => 'APPLICATION/JSON',
        ]);
    }
    public function loadBaseUrl():string
    {
        $domain = str($this->domain)->apa()->camel();
        return config("services.services.{$domain}");
    }

    public function setMethod(string $newMethod): static
    {
        $this->method = $newMethod;
        return $this;
    }
}
