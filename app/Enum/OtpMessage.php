<?php

namespace App\Enum;

use App\Core\Enum\Manager as Enum;

class OtpMessage extends Enum
{
    public const OTP_VERIFIED = 'Your Otp Verified';
    public const OTP_SEND = 'Your Otp Sent';
    public const OTP_CANCELED = 'Your Verify Otp Canceled';

    public const VALUES = [
        self::OTP_VERIFIED,
        self::OTP_SEND,
        self::OTP_CANCELED,
    ];
    public const FORMATS = [
        self::OTP_VERIFIED => self::OTP_VERIFIED,
        self::OTP_SEND => self::OTP_SEND,
        self::OTP_CANCELED => self::OTP_CANCELED,
    ];
}
