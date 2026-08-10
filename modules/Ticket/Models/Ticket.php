<?php

namespace Modules\Ticket\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Modules\Core\Contracts\Userable;
use Modules\Core\Traits\SoftDeletes;
use Modules\Core\Contracts\Statusable;
use Modules\Core\Contracts\Ticketable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Contracts\Commentable;
use Modules\Core\Contracts\Departmentable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Ticket\Databases\Factories\TicketFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $id
 * @property string $title
 * @property string|null $description
 * @property string $created_by
 * @property string $department_id
 * @property string $assigned_department_id
 * @property string $current_status_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
#[Fillable(['title', 'description', 'created_by'])]
class Ticket extends Model implements Ticketable
{
    /** @use HasFactory<TicketFactory> */
    use HasFactory;

    use HasUlids;
    use LogsActivity;
    use SoftDeletes;

    /**
     * @return Factory<Ticket>
     */
    protected static function newFactory(): Factory
    {
        return TicketFactory::new();
    }

    /**
     * @return BelongsTo<Model&Userable, $this>
     */
    public function createdBy(): BelongsTo
    {
        /** @var class-string<Model&Userable> $model */
        $model = app(Userable::class)::class;

        return $this->belongsTo(
            related: $model,
            foreignKey: 'created_by'
        );
    }

    /**
     * @return BelongsTo<Model&Departmentable, $this>
     */
    public function department(): BelongsTo
    {
        /** @var class-string<Model&Departmentable> $model */
        $model = app(Departmentable::class)::class;

        return $this->belongsTo(related: $model);
    }

    /**
     * @return BelongsTo<Model&Departmentable, $this>
     */
    public function assignee(): BelongsTo
    {
        /** @var class-string<Model&Departmentable> $model */
        $model = app(Departmentable::class)::class;

        return $this->belongsTo(
            related: $model,
            foreignKey: 'assigned_department_id',
            ownerKey: 'id'
        );
    }

    /**
     * @return HasOne<Model&Statusable, $this>
     */
    public function status(): HasOne
    {
        /** @var class-string<Model&Statusable> $model */
        $model = app(Statusable::class)::class;

        return $this->hasOne(
            related: $model,
            foreignKey: 'id',
            localKey: 'current_status_id'
        );
    }

    /**
     * @return BelongsToMany<Model&Statusable, $this>
     */
    public function statuses(): BelongsToMany
    {
        /** @var class-string<Model&Statusable> $model */
        $model = app(Statusable::class)::class;

        return $this->BelongsToMany(
            related: $model,
            table: 'ticket_status',
            foreignPivotKey: 'ticket_id',
            relatedPivotKey: 'status_id'
        );
    }

    /**
     * @return HasMany<Model&Commentable, $this>
     */
    public function comments(): HasMany
    {
        /** @var class-string<Model&Commentable> $model */
        $model = app(Commentable::class)::class;

        return $this->hasMany(
            related: $model,
            foreignKey: 'ticket_id',
            localKey: 'id'
        );
    }
}
