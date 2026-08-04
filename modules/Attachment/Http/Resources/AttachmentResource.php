<?php

namespace Modules\Attachment\Http\Resources;

use Illuminate\Http\Request;
use Modules\Attachment\Models\Attachment;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Attachment */
class AttachmentResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            /**
             * The unique identifier for the attachment.
             *
             * @example 01k1k9r0722ky8jm3n4snx90wn
             */
            'id' => $this->id,

            /**
             * The original name of the file as uploaded by the user.
             *
             * @example example_document.pdf
             */
            'original_name' => $this->original_name,

            /**
             * The MIME type of the file, indicating the format of the file.
             *
             * @example application/pdf
             */
            'mime_type' => $this->mime_type,

            /**
             * The URL where the attachment can be accessed.
             *
             * @example https://example.com/attachments/01k1k9r0722ky8jm3n4snx90wn
             */
            'url' => $this->url,

            /**
             * The uploader of the attachment
             *
             * @example 01k1k9r0722ky8jm3n4snx90wn
             */
            'uploaded_by' => $this->uploaded_by,

            /**
             * The date on when the attachment was created.
             *
             * @format date
             *
             * @example 2026-08-05T5:30:00Z
             */
            'created_at' => $this->created_at,

            /**
             * The date on when the attachment was updated.
             *
             * @format date
             *
             * @example 2026-08-05T5:30:00Z
             */
            'updated_at' => $this->updated_at,

            /**
             * The date on when the attachment was deleted.
             *
             * @format date
             *
             * @example 2026-08-05T5:30:00Z
             */
            'deleted_at' => $this->deleted_at,
        ];
    }
}
