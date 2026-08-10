<?php

namespace Modules\Users\Database\Factories;

use Illuminate\Support\Carbon;
use Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'first_name'  => $this->faker->firstName(),
            'middle_name' => $this->faker->name(),
            'last_name'   => $this->faker->lastName(),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ];
    }
}
