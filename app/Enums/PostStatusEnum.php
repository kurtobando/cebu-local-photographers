<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum PostStatusEnum: string
{
    use EnumTrait;

    case PUBLISHED = 'published';
    case DRAFT = 'draft';
    case PENDING = 'pending';
    case REJECTED = 'rejected';
    case SPAM = 'spam';
}
