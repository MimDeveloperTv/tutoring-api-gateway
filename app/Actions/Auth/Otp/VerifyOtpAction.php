<?php

namespace App\Actions\Auth\Otp;

use App\Enum\Field;
use App\Enum\OtpMessage as Message;
use App\Enum\UserPurview;
use App\Transporter\Auth\Otp\VerifyOtpRequest;
use Illuminate\Http\Client\RequestException;
use Lorisleiva\Actions\Concerns\AsAction;

class VerifyOtpAction
{
    use AsAction;

    private string $purview = UserPurview::NOT_REGISTERED;

    /**
     * @throws RequestException
     */
    public function handle(string $username, string $otp): object
    {
        $httpResponse = VerifyOtpRequest::build()
            ->withData([
            Field::USERNAME => $username,
            Field::OTP => $otp,
        ])->send()
         ->throw()
         ->json('data');

        $user = data_get($httpResponse, 'user');
        $userStatus = data_get($user, 'status.id');
        if (in_array($userStatus, UserPurview::PURVIEWS[UserPurview::REGISTERED])) {
            $this->purview = UserPurview::REGISTERED;
        }

        return (object)[
            Field::MESSAGE => Message::OTP_VERIFIED,
            Field::USER_PURVIEW => $this->purview,
            Field::USER => $user,
        ];

    }
}
