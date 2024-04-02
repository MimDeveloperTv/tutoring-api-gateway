<?php

namespace App\Http\Controllers\API\Auth\Otp;

use App\Actions\Auth\Otp\SendOtpAction;
use App\Actions\Auth\Otp\VerifyOtpAction;
use App\Actions\Auth\VerifyChallenge\VerifyChallengeAction;
use App\Enum\Field;
use App\Http\Controllers\API\Auth\BaseController;
use App\Http\Requests\API\Auth\Otp\ResendOtpRequest;
use App\Http\Requests\API\Auth\Otp\VerifyOtpRequest;
use App\Http\Resources\API\Auth\Otp\SendOtpResource;
use App\Http\Resources\API\Auth\Otp\VerifyOtpResource;
use Illuminate\Http\Client\RequestException;

class OtpController extends BaseController
{
    /**
     * @throws RequestException
     */
    public function verifyOtp(VerifyOtpRequest $request)
    {

       $verifyDto =  VerifyOtpAction::make()->handle($request->getUsername(),$request->getOtp());
       $challengeDto =  VerifyChallengeAction::make()->handle($verifyDto->user);

        $data = (object) [
            Field::MESSAGE => $verifyDto->{Field::MESSAGE},
            Field::USER_PURVIEW => $verifyDto->{Field::USER_PURVIEW},
            Field::USER => $verifyDto->{Field::USER},
            Field::IS_NEED_CHALLENGE => $challengeDto->{Field::IS_NEED_CHALLENGE},
            Field::VERIFY_CHALLENGE => $challengeDto->{Field::VERIFY_CHALLENGE},
        ];

       return VerifyOtpResource::make($data);
    }
    public function resendOtp(ResendOtpRequest $request)
    {

       $dto = SendOtpAction::make()->handle($request->getUsername());;
       return SendOtpResource::make($dto);
    }

}
