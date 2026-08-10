<?php

namespace Modules\Comment\Models;

use Carbon\Carbon;
use Modules\Users\Models\User;
use Modules\Core\Contracts\Userable;
use Modules\Core\Traits\SoftDeletes;
use Modules\Core\Contracts\Ticketable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Contracts\Commentable;
use Modules\Attachment\Traits\HasAttachments;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Comment\Database\Factories\CommentFactory;

/**
 * @property string $id
 * @property string $body
 * @property string $user_id
 * @property string $ticket_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */
#[Fillable(['comment'])]
class Comment extends Model implements Commentable
{
    use HasAttachments;

    /** @use HasFactory<CommentFactory> */
    use HasFactory;
    use HasUlids;
    use LogsActivity;
    use SoftDeletes;

    /**
     * @return Factory<Comment>
     */
    protected static function newFactory(): Factory
    {
        return CommentFactory::new();
    }

    /**
     * @return HasOne<Model&Ticketable, $this>
     */
    public function ticket(): HasOne
    {
        /** @var class-string<Model&Ticketable> $model */
        $model = app(Ticketable::class)::class;

        return $this->hasOne(
            related: $model,
            foreignKey: 'id',
            localKey: 'ticket_id'
        );
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: app(Userable::class)::class,
        );
    }
}
