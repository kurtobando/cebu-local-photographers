<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum CommentStatusEnum: string
{
    use EnumTrait;

    case PUBLISHED = 'published';
    case UNPUBLISHED = 'unpublished';
}
