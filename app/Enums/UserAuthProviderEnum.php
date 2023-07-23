<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum UserAuthProviderEnum: string
{
    use EnumTrait;

    case GOOGLE = 'google';
    case DEFAULT = 'default';
}
