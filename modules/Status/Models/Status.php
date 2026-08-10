<?php

namespace Modules\Status\Models;

use Carbon\Carbon;
use Modules\Core\Traits\SoftDeletes;
use Modules\Core\Contracts\Statusable;
use Modules\Core\Contracts\Ticketable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Status\Database\Factories\StatusFactory;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property Carbon|null $id
 * @property Carbon|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
#[Fillable(['status'])]
class Status extends Model implements Statusable
{
    /** @use HasFactory<StatusFactory> */
    use HasFactory;

    use HasUlids;
    use LogsActivity;
    use SoftDeletes;

    /**
     * @return Factory<Status>
     */
    protected static function newFactory(): Factory
    {
        return StatusFactory::new();
    }

    /**
     * @return BelongsToMany<Model&Ticketable, $this>
     */
    public function tickets(): BelongsToMany
    {
        /** @var class-string<Model&Ticketable> $model */
        $model = app(Ticketable::class)::class;

        return $this->BelongsToMany(
            related: $model,
            table: 'ticket_status',
            foreignPivotKey: 'status_id',
            relatedPivotKey: 'ticket_id'
        );
    }
}
