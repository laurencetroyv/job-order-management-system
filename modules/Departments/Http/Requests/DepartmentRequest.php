<?php

namespace Modules\Departments\Http\Requests;

use Modules\Departments\Enums\DepartmentPermissions;

class DepartmentRequest extends ShowDepartmentRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:64', 'unique:departments,name'],
            ...$this->relationshipParameter(config('relationships.departments')),
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->canAny([DepartmentPermissions::Create, DepartmentPermissions::Update]);
    }
}
