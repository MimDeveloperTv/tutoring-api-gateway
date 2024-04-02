<?php

namespace App\Enum;

use App\Core\Enum\Manager as Enum;

class UserPurview extends Enum
{
    public const KEY = 'user_purview';
    public const NOT_REGISTERED = 'NOT_REGISTERED';
    public const REGISTERED = 'REGISTERED';

    public const VALUES = [
        self::NOT_REGISTERED,
        self::REGISTERED,
    ];

    public const FORMATS = [
        self::NOT_REGISTERED => self::NOT_REGISTERED,
        self::REGISTERED => self::REGISTERED,
    ];

    public const PURVIEWS = [
        self::NOT_REGISTERED => [UserStatus::NOT_REGISTERED, UserStatus::VERIFY_OTP],
        self::REGISTERED => [UserStatus::REGISTERED],
    ];

}
