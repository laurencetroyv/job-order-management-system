<?php

namespace Modules\Users\Http\Resources;

use Illuminate\Http\Request;
use Modules\Users\Models\User;
use Modules\Core\Contracts\Attachmentable;
use Modules\Core\Registry\ResourceRegistry;
use Modules\Core\Http\Resources\SkeletonResource;

/** @mixin User */
class UserResource extends SkeletonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->request = $request;

        return [
            'id'          => $this->id,
            'first_name'  => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name'   => $this->last_name,
            'full_name'   => $this->full_name,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,

            'attachment' => $this->whenLoaded(
                'attachment',
                null,
                ResourceRegistry::make(Attachmentable::class, $this->whenLoaded('attachment'))
            ),

            'attachments' => $this->whenLoaded(
                'attachments',
                [],
                ResourceRegistry::make(Attachmentable::class, $this->whenLoaded('attachments'))
            ),
        ];
    }
}
