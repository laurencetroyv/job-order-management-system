<?php

namespace Modules\Core\Traits;

use BackedEnum;

trait HasValues
{
    /**
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * @param  array<int, BackedEnum|string>|BackedEnum  $exclude
     * @return array<int, mixed>
     */
    public static function valuesExcept(BackedEnum|array $exclude): array
    {
        if ($exclude instanceof BackedEnum) {
            $exclude = [$exclude->value];
        } else {
            $exclude = array_map(
                static fn (BackedEnum|string $enum) => $enum instanceof BackedEnum ? $enum->value : $enum,
                $exclude,
            );
        }

        return array_diff(static::values(), $exclude);
    }
}
