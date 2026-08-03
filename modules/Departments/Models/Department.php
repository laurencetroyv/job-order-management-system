<?php

namespace Modules\Departments\Models;

use Carbon\Carbon;
use Modules\Core\Models\Model;
use Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\Factory;
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
final class Department extends Model
{
    /** @use HasFactory<DepartmentFactory> */
    use HasFactory;

    use HasUlids;

    /**
     * @return BelongsToMany<User, $this>
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            related: User::class,
            table: 'department_user',
            foreignPivotKey: 'department_id',
            relatedPivotKey: 'user_id',
        );
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory<Department>
     */
    protected static function newFactory(): Factory
    {
        return DepartmentFactory::new();
    }
}
