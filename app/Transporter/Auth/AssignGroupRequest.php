<?php

namespace App\Transporter\Auth;

use App\Core\Transporter\BaseRequest;
use App\Enum\Method;
use Illuminate\Http\Client\PendingRequest;

class AssignGroupRequest extends BaseRequest
{
    public const NAME = 'assign-group';
    protected string $domain = 'USER_MANAGEMENT';
    protected string $method = Method::POST;
    protected string $path = '/assign-group';
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
