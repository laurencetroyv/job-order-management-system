<?php

namespace Modules\Ticket\Http\Resources;

use Illuminate\Http\Request;
use Modules\Ticket\Models\Ticket;
use Modules\Users\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Ticket */
class TicketResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,

            'created_by' => $this->created_by,

            'createdBy' => new UserResource($this->whenLoaded('createdBy')),
        ];
    }
}
