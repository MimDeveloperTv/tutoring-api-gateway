<?php

namespace App\Transporter\Auth\Otp;

use App\Core\Transporter\BaseRequest;
use App\Enum\Method;
use Illuminate\Http\Client\PendingRequest;

class VerifyOtpRequest extends BaseRequest
{
    public const NAME = 'verify-otp';
    protected string $domain = 'USER_MANAGEMENT';
    protected string $method = Method::POST;
    protected string $path = '/verify-otp';
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
