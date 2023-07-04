<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\Blade;
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GenerateGoodsFromImport::class);

        $this->app->singleton(DeleteImport::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'bewama');
        //    Blade::componentNamespace('Nightshade\\Views\\Components', 'nightshade');
    }
}
