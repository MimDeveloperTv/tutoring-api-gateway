<?php

namespace App\Transporter\Auth;

use App\Core\Transporter\BaseRequest;
use App\Enum\Method;
use Illuminate\Http\Client\PendingRequest;

class CheckUserRequest extends BaseRequest
{
    public const NAME = 'check-user';
    protected string $domain = 'USER_MANAGEMENT';
    protected string $method = Method::POST;
    protected string $path = '/login'; //todo:change to check-user name
    protected array $data = [];

    protected function withRequest(PendingRequest $request): void
    {
        parent::withRequest($request);
    }
    public function withData(array $data): static
    {
        $this->data = $data;

        return  $this;
    }
}
