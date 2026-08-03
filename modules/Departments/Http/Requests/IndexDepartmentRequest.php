<?php

namespace Modules\Departments\Http\Requests;

use Modules\Core\Http\Requests\IndexSkeletonRequest;
use Modules\Departments\Enums\DepartmentPermissions;

class IndexDepartmentRequest extends IndexSkeletonRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            ...$this->indexDefaultParameters(),
            ...$this->relationshipParameter(config('relationships.departments')),
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->can(DepartmentPermissions::Index);
    }
}
