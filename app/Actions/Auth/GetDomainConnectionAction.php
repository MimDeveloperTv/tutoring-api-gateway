<?php

namespace App\Actions\Auth;

use App\Transporter\Auth\GetDomainConnectionRequest;
use Illuminate\Validation\UnauthorizedException;
use Lorisleiva\Actions\Concerns\AsAction;

class GetDomainConnectionAction
{
    use AsAction;

    /**
     */
    public function handle(): string
    {
        $response = GetDomainConnectionRequest::build()->send();
        abort_unless($response->ok(), UnauthorizedException::class);
      return  CreateUserConnectionAction::make()->handle($response->json('connection'));
    }
}
