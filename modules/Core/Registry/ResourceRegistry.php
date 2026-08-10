<?php

namespace Modules\Core\Registry;

use RuntimeException;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ResourceRegistry
{
    /**
     * @var array<int, mixed>
     */
    protected static array $factories = [];

    /**
     * @param  class-string<JsonResource>  $resourceClass
     */
    public static function register(string $contract, string $resourceClass): void
    {
        static::$factories[$contract] = $resourceClass;
    }

    /**
     * @return class-string<JsonResource>
     */
    public static function resolve(string $contract): string
    {
        return static::$factories[$contract]
            ?? throw new RuntimeException("No resource factory registered for contract '{$contract}'.");
    }

    public static function make(string $contract, mixed $resource): JsonResource
    {
        return static::resolve($contract)::make($resource);
    }

    public static function collection(string $contract, mixed $resource): AnonymousResourceCollection
    {
        return static::resolve($contract)::collection($resource);
    }
}
