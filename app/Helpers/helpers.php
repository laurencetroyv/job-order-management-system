<?php

use Spatie\LaravelData\Optional;

if (! function_exists('isDataProvided')) {
    /**
     * Determine whether the value is not marked as an omitted field.
     *
     * Internally, Laravel Data represents omitted properties using an Optional marker.
     */
    function isDataProvided(mixed $value): bool
    {
        return ! ($value instanceof Optional);
    }
}
