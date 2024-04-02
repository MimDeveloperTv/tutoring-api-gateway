<?php

namespace App\Core\Enum;

use Illuminate\Support\Collection;
abstract class Manager
{
    public const KEY = 'key';
     public const VALUES = [];
    public const FORMATS = [];
    public static  function format($value): ?array
    {
        $key = data_get(static::FORMATS,$value);
        if(!empty($key)) {
            return static::formatter($key);
        }
        return null;

    }
    public static function mapper(array $enum): Collection
    {
        return collect($enum)->map(fn($key) => self::formatter($key));
    }

    public static function mappers(array $enums): Collection
    {
        $enumArrays = collect($enums)->mapWithKeys(fn($enum) => [$enum::KEY =>  self::mapper($enum::VALUES)->toArray()]);
        return  $enumArrays;
    }
    public static function formatter(string $key): array
    {
        return [
            'id' => $key,
            'title' => __("enums.{$key}")
        ];
    }
}
