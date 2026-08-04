<?php

namespace Modules\Attachment\Database\Factories;

use Illuminate\Support\Carbon;
use Modules\Attachment\Models\Attachment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attachment>
 */
class AttachmentFactory extends Factory
{
    protected $model = Attachment::class;

    public function definition(): array
    {
        return [
            'original_name' => $this->faker->name(),
            'file_name'     => $this->faker->name(),
            'file_path'     => $this->faker->word(),
            'mime_type'     => $this->faker->word(),
            'file_size'     => $this->faker->randomNumber(),
            'uploaded_by'   => $this->faker->name(),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ];
    }
}
