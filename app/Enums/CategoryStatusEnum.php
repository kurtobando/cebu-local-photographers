<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum CategoryStatusEnum: string
{
    use EnumTrait;

    case PUBLISHED = 'published';
    case UNPUBLISHED = 'unpublished';
}
