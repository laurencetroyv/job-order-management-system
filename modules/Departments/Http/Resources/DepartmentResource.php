<?php

namespace Modules\Departments\Http\Resources;

use Illuminate\Http\Request;
use Modules\Core\Contracts\Userable;
use Modules\Departments\Models\Department;
use Modules\Core\Registry\ResourceRegistry;
use Modules\Core\Http\Resources\SkeletonResource;

/** @mixin Department */
class DepartmentResource extends SkeletonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->request = $request;

        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,

            'users' => $this->whenRequested(
                fieldName: 'users',
                default: [],
                resource: ResourceRegistry::collection(Userable::class, $this->whenLoaded('users')),
            ),
        ];
    }
}
