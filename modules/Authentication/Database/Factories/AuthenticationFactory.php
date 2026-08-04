<?php

namespace Modules\Authentication\Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Modules\Authentication\Models\Authentication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Authentication>
 */
class AuthenticationFactory extends Factory
{
    protected $model = Authentication::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username'          => fake()->userName(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
