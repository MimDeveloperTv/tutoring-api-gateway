<?php

namespace App\Enum;

use App\Core\Enum\Manager as Enum;

class Method extends Enum
{
    public const POST = 'POST';
    public const GET = 'GET';
    public const PUT = 'PUT';
    public const PATCH = 'PATCH';
    public const DELETE = 'DELETE';

    public const VALUES = [
        self::POST,
        self::GET,
        self::PUT,
        self::PATCH,
        self::DELETE,
    ];
    public const FORMATS = [
        self::POST => self::POST,
        self::GET => self::GET,
        self::PUT => self::PUT,
        self::PATCH => self::PATCH,
        self::DELETE => self::DELETE,
    ];
}
