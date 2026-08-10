<?php

namespace App\Enum;

use Modules\Core\Traits\HasValues;

enum RoleEnum: string
{
    use HasValues;

    case SuperAdmin = 'super_admin';

    case DepartmentAdmin = 'department_admin';

    case LineWorker = 'line_worker';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin      => 'Super Admin',
            self::DepartmentAdmin => 'Department Admin',
            self::LineWorker      => 'Line Worker',
        };
    }
}
