<?php

namespace Modules\Comment\Http\Resources;

use Illuminate\Http\Request;
use Modules\Comment\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Comment */
class CommentResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'comment'    => $this->body,
            'user_id'    => $this->user_id,
            'ticket_id'  => $this->ticket_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
