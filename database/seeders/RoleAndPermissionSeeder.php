<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Enum\RoleEnum;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Modules\Users\Enum\UserPermissions;
use Modules\Departments\Enums\DepartmentPermissions;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedRoles();
        $this->seedSuperAdminRoleAndPermissions();
        $this->seedDepartmentRoleAndPermissions();
        $this->seedLineWorkerRoleAndPermissions();
    }

    public function seedRoles(): void
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

    public function seedSuperAdminRoleAndPermissions(): void
    {
        $this->command->info('Seeding SuperAdmin Role and Permissions');
        $role = Role::where('name', RoleEnum::SuperAdmin)->first();
        $permissions = [
            ...DepartmentPermissions::values(),
            ...UserPermissions::values(),
        ];

        $perms = [];

        foreach ($permissions as $permission) {
            $perms[] = Permission::createOrFirst(['name' => $permission], ['guard_name' => 'web']);
        }

        $role->permissions()->sync($perms, false);
    }

    public function seedDepartmentRoleAndPermissions(): void
    {
        $role = Role::where('name', RoleEnum::DepartmentAdmin)->first();
        $perms = [];

        $departmentPermissions = DepartmentPermissions::values();

        foreach ($departmentPermissions as $permission) {
            $perms[] = Permission::createOrFirst(
                ['name' => $permission],
                ['guard_name' => 'web']
            );
        }

        $role->permissions()->sync($perms, false);
    }

    public function seedLineWorkerRoleAndPermissions(): void
    {
        $role = Role::where('name', RoleEnum::LineWorker)->first();
        $perms = [];

        $userPermissions = [
            UserPermissions::Update,
        ];

        foreach ($userPermissions as $permission) {
            $perms[] = Permission::createOrFirst(
                ['name' => $permission],
                ['guard_name' => 'web']
            );
        }

        $role->permissions()->sync($perms, false);
    }
}
