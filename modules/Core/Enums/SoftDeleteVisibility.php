<?php

namespace Modules\Core\Enums;

enum SoftDeleteVisibility: string
{
    case IncludeDeleted = 'include_deleted';

    case ExcludeDeleted = 'exclude_deleted';

    case OnlyDeleted = 'only_deleted';
}
