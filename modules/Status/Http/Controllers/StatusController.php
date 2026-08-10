<?php

namespace Modules\Status\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Status\Models\Status;
use App\Http\Controllers\Controller;
use Modules\Status\Http\Requests\StatusRequest;
use Modules\Status\Http\Resources\StatusResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StatusController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return StatusResource::collection(Status::all());
    }

    public function store(StatusRequest $request): StatusResource
    {
        return new StatusResource(Status::create($request->validated()));
    }

    public function show(Status $status): StatusResource
    {
        return new StatusResource($status);
    }

    public function update(StatusRequest $request, Status $status): StatusResource
    {
        $status->update($request->validated());

        return new StatusResource($status);
    }

    public function destroy(Status $status): JsonResponse
    {
        $status->delete();

        return response()->json();
    }
}
