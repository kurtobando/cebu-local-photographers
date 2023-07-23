<?php

namespace App\Traits;

trait EnumTrait
{
    public static function toArray(string $key = 'value'): array
    {
        return array_column(self::cases(), $key);
    }

    public static function toKeyValueArray(): array
    {
        return array_combine(self::toArray('name'), self::toArray());
    }
}
