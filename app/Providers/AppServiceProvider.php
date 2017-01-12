<?php

namespace App\Providers;

use App\SiteRepository;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SiteRepository::class);
        $this->app->when(SiteRepository::class)->needs(Filesystem::class)->give(function () {
           return app('filesystem')->disk('local');
        });
    }
}
