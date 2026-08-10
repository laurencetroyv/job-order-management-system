<?php

namespace Modules\Departments\Models;

use Carbon\Carbon;
use Modules\Core\Models\Model;
use Modules\Core\Contracts\Userable;
use Modules\Core\Traits\SoftDeletes;
use Modules\Core\Contracts\Departmentable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Departments\Database\Factories\DepartmentFactory;

/**
 * @property string $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
#[Fillable(['name'])]
final class Department extends Model implements Departmentable
{
    /** @use HasFactory<DepartmentFactory> */
    use HasFactory;

    use HasUlids;
    use LogsActivity;
    use SoftDeletes;

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory<Department>
     */
    protected static function newFactory(): Factory
    {
        return DepartmentFactory::new();
    }

    /**
     * @return BelongsToMany<Model&Userable, $this>
     */
    public function users(): BelongsToMany
    {
        /** @var class-string<Model&Userable> $model */
        $model = app(Userable::class)::class;

        return $this->belongsToMany(
            related: $model,
            table: 'department_user',
            foreignPivotKey: 'department_id',
            relatedPivotKey: 'user_id',
        );
    }
}
