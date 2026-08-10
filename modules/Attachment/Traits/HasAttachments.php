<?php

namespace Modules\Attachment\Traits;

use Storage;
use Illuminate\Support\Str;
use Modules\Core\Models\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Modules\Attachment\Models\Attachment;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @mixin Model
 */
trait HasAttachments
{
    /**
     * @return MorphMany<Attachment, $this>
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    /**
     * @return MorphOne<Attachment, $this>
     */
    public function attachment(): MorphOne
    {
        return $this->morphOne(Attachment::class, 'attachmentable')
            ->latestOfMany();
    }

    public function addAttachment(
        UploadedFile $file,
        string $folder,
        bool $hasUploadedBy = true,
        ?string $uploaderId = null
    ): Attachment {
        $fileName = Str::ulid().'.'.$file->getClientOriginalExtension();

        $path = empty($folder)
            ? 'general'
            : $folder;

        $filePath = $file->storeAs($path, $fileName);

        return $this->attachment()->create([
            'original_name' => $file->getClientOriginalName(),
            'file_name'     => $fileName,
            'file_path'     => $filePath,
            'mime_type'     => $file->getMimeType(),
            'file_size'     => $file->getSize(),
            'uploaded_by'   => $hasUploadedBy ? \Auth::user()->user()->id ?? null : $uploaderId,
        ]);
    }

    /**
     * @param  Collection<int, UploadedFile>|UploadedFile[]  $files
     * @return Collection<int, Attachment>
     */
    public function addAttachments(Collection|array $files, string $folder, bool $has_uploaded_by = true): Collection
    {
        /** @var Collection<int, Attachment> $newCollection */
        $newCollection = collect();

        foreach ($files as $file) {
            $savedAttachment = $this->addAttachment($file, $folder, $has_uploaded_by);
            $newCollection->add($savedAttachment);
        }

        return $newCollection;
    }

    public function softDeleteAttachment(string $id): bool
    {
        $attachment = $this->attachment()->where('id', $id)->first();

        if (! $attachment) {
            return false;
        }

        return $attachment->delete();
    }

    public function forceDeleteAttachment(string $id): bool
    {
        $attachment = $this->attachment()->where('id', $id)->first();
        if (! $attachment) {
            return false;
        }

        Storage::delete($attachment->file_path);

        return $attachment->forceDelete();
    }
}
