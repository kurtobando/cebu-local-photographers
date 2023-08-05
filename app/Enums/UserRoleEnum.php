<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum UserRoleEnum: string
{
    use EnumTrait;

    case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case MODERATOR = 'moderator';
    case USER = 'user';
}
