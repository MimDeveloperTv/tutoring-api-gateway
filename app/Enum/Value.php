<?php

namespace App\Enum;

use App\Core\Enum\Manager as Enum;

class Value extends Enum
{
    public const EXIST_MEMBER_GROUP = true;

    public const VALUES = [
        self::EXIST_MEMBER_GROUP,
    ];
    public const FORMATS = [
        self::EXIST_MEMBER_GROUP => self::EXIST_MEMBER_GROUP,
    ];

}
