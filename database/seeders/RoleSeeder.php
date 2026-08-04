<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Enum\RoleEnum;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->comment('Seeding Roles');

        $roles = RoleEnum::values();

        foreach ($roles as $role) {
            Role::createOrFirst([
                'name'       => $role,
                'guard_name' => 'web',
            ]);
        }

        $this->command->info('Seeding Roles Done');
    }
}
