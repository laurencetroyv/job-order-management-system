<?php

namespace Modules\Users\Enum;

use Modules\Core\Traits\HasValues;

enum UserPermissions: string
{
    use HasValues;

    case Index = 'users.index';
    case View = 'users.view';
    case Create = 'users.create';
    case Update = 'users.update';
    case Delete = 'users.delete';
    case Restore = 'users.restore';

    public function label(): string
    {
        return match ($this) {
            self::Index   => 'Index User',
            self::View    => 'View User',
            self::Create  => 'Create User',
            self::Update  => 'Update User',
            self::Delete  => 'Delete User',
            self::Restore => 'Restore User',
        };
    }
}
