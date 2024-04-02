<?php

namespace App\Enum;

use App\Core\Enum\Manager as Enum;

class Gender extends Enum
{
    public const KEY = 'gender';
    public const MALE = 'MALE';
    public const FEMALE = 'FEMALE';
    public const OTHER = 'OTHER';

    public const VALUES = [
        self::MALE,
        self::FEMALE,
        self::OTHER,
    ];
    public const FORMATS = [
        self::MALE => self::MALE,
        self::FEMALE => self::FEMALE,
        self::OTHER => self::OTHER,
    ];
}
