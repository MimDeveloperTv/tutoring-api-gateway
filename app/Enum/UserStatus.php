<?php

namespace App\Enum;

use App\Core\Enum\Manager as Enum;
class UserStatus extends Enum
{
    public const KEY = 'user_status';
    public const NOT_REGISTERED = 'NOT_REGISTERED';
    public const VERIFY_OTP = 'VERIFY_OTP';
    public const REGISTERED = 'REGISTERED';

    public const VALUES = [
        self::NOT_REGISTERED,
        self::VERIFY_OTP,
        self::REGISTERED,
    ];

    public const FORMATS = [
        self::NOT_REGISTERED => self::NOT_REGISTERED,
        self::VERIFY_OTP => self::VERIFY_OTP,
        self::REGISTERED => self::REGISTERED,
    ];

}
