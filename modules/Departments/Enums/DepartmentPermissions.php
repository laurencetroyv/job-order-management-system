<?php

namespace Modules\Departments\Enums;

use Modules\Core\Traits\HasValues;

enum DepartmentPermissions: string
{
    use HasValues;

    case Index = 'department.index';
    case View = 'departments.view';
    case Create = 'departments.create';
    case Update = 'departments.update';
    case Delete = 'departments.delete';
    case Restore = 'departments.restore';

    public function label(): string
    {
        return match ($this) {
            self::Index   => 'Index Department',
            self::View    => 'View Department',
            self::Create  => 'Create Department',
            self::Update  => 'Update Department',
            self::Delete  => 'Delete Department',
            self::Restore => 'Restore Department',
        };
    }
}
