<?php

namespace Modules\Departments\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Departments\Models\Department;
use Modules\Departments\Services\DepartmentService;
use Modules\Departments\Enums\DepartmentPermissions;
use Illuminate\Routing\Attributes\Controllers\Authorize;
use Modules\Departments\Http\Requests\DepartmentRequest;
use Modules\Departments\Http\Resources\DepartmentResource;
use Modules\Departments\Http\Requests\ShowDepartmentRequest;
use Modules\Departments\Http\Requests\IndexDepartmentRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DepartmentController extends Controller
{
    public function __construct(
        private readonly DepartmentService $departmentService,
    ) {}

    #[Authorize(DepartmentPermissions::Index)]
    public function index(IndexDepartmentRequest $request): AnonymousResourceCollection
    {
        $data = $this->departmentService->getAllDepartments($request);

        return DepartmentResource::collection($data);
    }

    #[Authorize(DepartmentPermissions::Create)]
    public function store(DepartmentRequest $request): DepartmentResource
    {
        $data = $this->departmentService->createDepartment($request);

        return DepartmentResource::make($data);
    }

    #[Authorize(DepartmentPermissions::View)]
    public function show(ShowDepartmentRequest $request, Department $department): DepartmentResource
    {
        $data = $this->departmentService->showDepartment($request, $department);

        return DepartmentResource::make($data);
    }

    #[Authorize(DepartmentPermissions::Update)]
    public function update(DepartmentRequest $request, Department $department): DepartmentResource
    {
        $data = $this->departmentService->updateDepartment($request, $department);

        return DepartmentResource::make($data);
    }

    #[Authorize(DepartmentPermissions::Delete)]
    public function destroy(Department $department): Response
    {
        $this->departmentService->deleteDepartment($department);

        return response()->noContent();
    }

    #[Authorize(DepartmentPermissions::Restore)]
    public function restore(ShowDepartmentRequest $request, Department $department): DepartmentResource
    {
        $data = $this->departmentService->restoreDepartment($request, $department);

        return DepartmentResource::make($data);
    }
}
