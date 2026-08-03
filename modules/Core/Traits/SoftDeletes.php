<?php

namespace Modules\Core\Traits;

use Modules\Core\Models\Model;
use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Enums\SoftDeleteVisibility;
use Illuminate\Database\Eloquent\SoftDeletes as BaseSoftDeletes;

trait SoftDeletes
{
    use BaseSoftDeletes;

    /**
     * @param  Builder<covariant Model>  $builder
     */
    public function scopeSoftDelete(Builder $builder, SoftDeleteVisibility $mode = SoftDeleteVisibility::ExcludeDeleted): void
    {
        if ($mode === SoftDeleteVisibility::ExcludeDeleted) {
            return;
        }

        if ($mode === SoftDeleteVisibility::OnlyDeleted) {
            $builder->onlyTrashed();
        }

        if ($mode === SoftDeleteVisibility::IncludeDeleted) {
            $builder->withTrashed();
        }
    }
}
