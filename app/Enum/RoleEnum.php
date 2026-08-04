<?php

namespace App\Enum;

use Modules\Core\Traits\HasValues;

enum RoleEnum: string
{
    use HasValues;

    case SuperAdmin = 'super_admin';

    case DepartmentAdmin = 'department_admin';

    case LineWorker = 'line_worker';
}
