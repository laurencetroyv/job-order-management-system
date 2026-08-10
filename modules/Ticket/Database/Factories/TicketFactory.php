<?php

namespace Modules\Ticket\Databases\Factories;

use Illuminate\Support\Carbon;
use Modules\Users\Models\User;
use Modules\Ticket\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'title'       => $this->faker->word(),
            'description' => $this->faker->text(),
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now(),

            'created_by' => User::factory(),
        ];
    }
}
