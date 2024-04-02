<?php

namespace App\Actions\Auth;

use App\Enum\Field;
use App\Enum\OtpMessage as Message;
use App\Enum\UserStatus;
use App\Transporter\Auth\AssignGroupRequest;
use App\Transporter\Auth\RegisterRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Validation\UnauthorizedException;
use Lorisleiva\Actions\Concerns\AsAction;

class AssignGroupUserAction
{
    use AsAction;

    private bool $isRegistered =false;

    /**
     * @throws RequestException
     * @throws \Throwable
     */
    public function handle(string $userId,string $userGroup):bool
    {
        $httpResponse = AssignGroupRequest::build()->withData([
            Field::USER_ID => $userId,
            Field::USER_GROUP => $userGroup,
        ])->send()->throw();
        $response = $httpResponse->json('data');
        throw_unless(data_get($response,'is_assigned'),UnauthorizedException::class);
        return true;
    }
}
