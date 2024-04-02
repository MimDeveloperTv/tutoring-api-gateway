<?php

namespace App\Actions\Auth\Lookup;

use App\Actions\Auth\Otp\SendOtpAction;
use App\Enum\Field;
use App\Enum\LookupAction as Action;
use App\Enum\UserStatus;
use Illuminate\Http\Client\RequestException;
use Lorisleiva\Actions\Concerns\AsAction;

class AfterLookupAction
{
    use AsAction;

    /**
     * @throws RequestException
     */
    public function handle(array $dto, string $username):object
    {
        if(!$dto[Field::IS_USER]){
            $dto[Field::ACTION] = $this->registerUser($username);
        }
        else{
            $dto[Field::ACTION] = match ($dto[Field::USER_STATUS]) {
                UserStatus::VERIFY_OTP => $this->otpUser($username),
                UserStatus::REGISTERED => $this->registeredUser($username),
            };
        }

        return  (object) $dto;
    }

    public function registeredUser(string $username): string
    {
        //todo :  notification login and welcome
        return Action::LOGIN;
    }

    /**
     * @throws RequestException
     */
    public function otpUser(string $username): string
    {
        SendOtpAction::make()->handle($username);
        return Action::OTP;
    }

    public function registerUser(string $username): string
    {
        SendOtpAction::make()->handle($username);
        return Action::REGISTER;
    }

}
