<?php

namespace App\Actions\Auth\Otp;

use App\Enum\Field;
use App\Enum\OtpMessage as Message;
use App\Transporter\Auth\Otp\SendOtpRequest;
use Illuminate\Http\Client\RequestException;
use Lorisleiva\Actions\Concerns\AsAction;

class SendOtpAction
{
    use AsAction;

    /**
     * @throws RequestException
     */
    public function handle(string $username):object
    {
        $httpResponse = SendOtpRequest::build()
            ->withData([Field::USERNAME => $username])
            ->send()
            ->throw();

        return (object) [
            Field::MESSAGE => Message::OTP_SEND
        ];
    }
}
