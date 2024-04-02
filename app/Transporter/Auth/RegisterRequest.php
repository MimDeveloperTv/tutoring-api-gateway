<?php

namespace App\Transporter\Auth;

use App\Core\Transporter\BaseRequest;
use App\Enum\Method;
use Illuminate\Http\Client\PendingRequest;

class RegisterRequest extends BaseRequest
{
    public const NAME = 'register';
    protected string $domain = 'USER_MANAGEMENT';
    protected string $method = Method::POST;
    protected string $path = '/register';
    protected array $data = [];

    protected function withRequest(PendingRequest $request): void
    {
        parent::withRequest($request);

        //todo : add Advanced Headers And Keys

       // $request->withHeaders(['X-USER-ID' => auth()->id(),]);
    }
    public function withData(array $data): static
    {
        $this->data = $data;

        return  $this;
    }
}
