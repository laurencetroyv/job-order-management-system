<?php

namespace Modules\Departments\Services;

use Illuminate\Support\Collection;
use Modules\Core\Traits\HasPagination;
use Modules\Departments\Models\Department;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Core\Http\Requests\IndexSkeletonRequest;
use Modules\Departments\Http\Requests\DepartmentRequest;
use Modules\Departments\Http\Requests\ShowDepartmentRequest;

class DepartmentService
{
    use HasPagination;

    /**
     * @return LengthAwarePaginator<int, Department>|Collection<int, Department>
     */
    public function getAllDepartments(IndexSkeletonRequest $request): LengthAwarePaginator|Collection
    {
        $validated = $request->validated();

        $query = Department::query()
            ->with($validated['with'] ?? [])
            ->softDelete($validated['soft_delete_visibility']);

        $this->applySearchQuery($query, $validated['search'] ?? '', Department::class);

        return $this->sortAndPaginate($query, $request);
    }

    public function createDepartment(DepartmentRequest $request): Department
    {
        $validated = $request->validated();
        $department = Department::createOrRestore($validated);
        $department::with($validated['with'] ?? []);

        return $department;
    }

    public function showDepartment(ShowDepartmentRequest $request, Department $department): Department
    {
        $validated = $request->validated();
        $department->with($validated['with'] ?? []);

        return $department;
    }

    public function updateDepartment(DepartmentRequest $request, Department $department): Department
    {
        $validated = $request->validated();
        $department->update($validated);
        $department->with($validated['with'] ?? []);

        return $department;
    }

    public function deleteDepartment(Department $department): void
    {
        $department->delete();
    }

    public function restoreDepartment(ShowDepartmentRequest $request, string $id): Department
    {
        $validated = $request->validated();
        $department = Department::with($validated['with'] ?? [])->onlyTrashed()->findOrFail($id);
        $department->restore();

        return $department;
    }
}
