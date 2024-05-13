<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Sitemap\Sitemap;

class SitemapJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct()
    {

    }

    public function handle(): void
    {
        Sitemap::create()
            ->add(route('home'))
            ->add(route('sign-in'))
            ->add(route('sign-up'))
            ->add(route('password-reset'))
            ->add(route('privacy'))
            ->add(route('term-of-service'))
            ->add(route('members'))
            ->writeToFile(public_path('sitemap.xml'));
    }
}
