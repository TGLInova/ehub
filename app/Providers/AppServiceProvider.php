<?php

namespace App\Providers;

use App\Models\Empresa;
use App\Services\Workspace;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Workspace::class, function ($app) {
            return new Workspace($app['request']);
        });

        $this->app->singleton('workspace.empresa', function($app): ?Empresa {
            return $app[Workspace::class]->empresa();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
