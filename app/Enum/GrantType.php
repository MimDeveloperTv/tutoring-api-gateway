<?php

namespace App\Enum;

use App\Core\Enum\Manager as Enum;

class GrantType extends Enum
{
    public const KEY = 'grant_type';
    public const PASSWORD = 'PASSWORD';

    public const IDENTIFIER = self::PASSWORD;
    public const VALUES = [
        self::PASSWORD,
    ];
    public const FORMATS = [
        self::PASSWORD => self::PASSWORD,
    ];
}
