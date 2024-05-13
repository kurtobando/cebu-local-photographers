<?php

namespace App\Gateway;

use Illuminate\Support\Str;
use Inertia\Ssr\HttpGateway;
use Inertia\Ssr\Response;

// refer to https://github.com/inertiajs/inertia/discussions/1429
class InertiaDisableSSRGateway extends HttpGateway
{
    public function dispatch(array $page): ?Response
    {
        if (isset($page['url']) && Str::is('/dashboard*', $page['url'])) {
            return null;
        }

        return parent::dispatch($page);
    }
}
