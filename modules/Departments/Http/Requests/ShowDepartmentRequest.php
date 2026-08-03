<?php

namespace Modules\Departments\Http\Requests;

use Modules\Core\Http\Requests\SkeletonRequest;
use Modules\Departments\Enums\DepartmentPermissions;

class ShowDepartmentRequest extends SkeletonRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            ...$this->relationshipParameter(config('relationships.departments')),
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->can(DepartmentPermissions::View);
    }
}
