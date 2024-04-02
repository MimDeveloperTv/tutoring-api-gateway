<?php

namespace App\Enum;

use App\Core\Enum\Manager as Enum;

class LookupAction extends Enum
{
    public const KEY = 'lookup_action';
    public const LOGIN = 'LOGIN';
    public const REGISTER = 'REGISTER';
    public const OTP = 'OTP';
    public const VALUES = [
        self::LOGIN,
        self::REGISTER,
        self::OTP,
    ];
    public const FORMATS = [
        self::LOGIN => self::LOGIN,
        self::REGISTER => self::REGISTER,
        self::OTP => self::OTP,
    ];
}
