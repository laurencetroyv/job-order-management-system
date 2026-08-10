<?php

namespace Modules\Users\Models;

use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Modules\Core\Models\Model;
use Modules\Core\Contracts\Userable;
use Modules\Attachment\Traits\HasAttachments;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Modules\Users\Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Activitylog\Models\Concerns\HasActivity;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $id
 * @property string|null $prefix
 * @property string $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property string|null $suffix
 * @property string|null $full_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
#[Appends(['full_name'])]
#[Fillable(['id', 'prefix', 'first_name', 'middle_name', 'last_name', 'suffix'])]
class User extends Model implements Userable
{
    use HasActivity;

    use HasAttachments;

    /** @use HasFactory<UserFactory> */
    use HasFactory;
    use HasUlids;
    use Searchable;

    protected string $guard_name = 'web';

    protected $casts = [
        'prefix'      => 'encrypted',
        'first_name'  => 'encrypted',
        'middle_name' => 'encrypted',
        'last_name'   => 'encrypted',
        'suffix'      => 'encrypted',
    ];

    protected $hidden = [
        'id',
    ];

    /**
     * @return Factory<User>
     */
    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    /**
     * @return Attribute<string, never>
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => trim(
                [
                    $this->prefix,
                    $this->first_name,
                    $this->middle_name,
                    $this->last_name,
                    $this->suffix,
                ]
                    |> array_filter(...)
                    |> (static fn ($x) => implode(' ', $x))
                    |> trim(...)
            )
        );
    }
}
