<?php

namespace Modules\Core\Models;

use Laravel\Scout\Searchable;
use Modules\Core\Traits\SoftDeletes;
use Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class Model extends EloquentModel
{
    use Searchable;
    use SoftDeletes;
}
