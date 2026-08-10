<?php

namespace Modules\Departments\Providers;

use Modules\Core\Contracts\Departmentable;
use Modules\Departments\Models\Department;
use Modules\Core\Providers\SkeletonServiceProvider;

class DepartmentServiceProvider extends SkeletonServiceProvider
{
    public function register(): void
    {
        parent::register();

        $this->app->bind(Departmentable::class, Department::class);
    }
}
