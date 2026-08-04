<?php

namespace Modules\Attachment\Models;

use Carbon\Carbon;
use Modules\Core\Traits\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Attachment\Database\Factories\AttachmentFactory;

/**
 * @property string $id
 * @property string $original_name
 * @property string $file_name
 * @property string $file_path
 * @property string $mime_type
 * @property int $file_size
 * @property string $uploaded_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
#[Appends(['url'])]
#[Fillable(['original_name', 'file_name', 'file_path', 'mime_type', 'file_size', 'uploaded_by'])]
class Attachment extends Model
{
    /** @use HasFactory<AttachmentFactory> */
    use HasFactory;

    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
        ];
    }

    /**
     * @return Factory<Attachment>
     */
    protected static function newFactory(): Factory
    {
        return AttachmentFactory::new();
    }

    /**
     * @return MorphTo<Model, $this>
     */
    public function attachmentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getUrlAttribute(): string
    {
        return Storage::temporaryUrl($this->file_path, now()->addMinutes(10));
    }
}
