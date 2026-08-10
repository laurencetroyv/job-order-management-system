<?php

namespace Modules\Ticket\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Ticket\Models\Ticket;
use App\Http\Controllers\Controller;
use Modules\Ticket\Http\Requests\TicketRequest;
use Modules\Ticket\Http\Resources\TicketResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return TicketResource::collection(Ticket::all());
    }

    public function store(TicketRequest $request): TicketResource
    {
        return new TicketResource(Ticket::create($request->validated()));
    }

    public function show(Ticket $ticket): TicketResource
    {
        return new TicketResource($ticket);
    }

    public function update(TicketRequest $request, Ticket $ticket): TicketResource
    {
        $ticket->update($request->validated());

        return new TicketResource($ticket);
    }

    public function destroy(Ticket $ticket): JsonResponse
    {
        $ticket->delete();

        return response()->json();
    }
}
