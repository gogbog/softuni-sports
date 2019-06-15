<?php

namespace App\Modules\Sports\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('sports', 'Resources/Lang', 'app'), 'sports');
        $this->loadViewsFrom(module_path('sports', 'Resources/Views', 'app'), 'sports');
        $this->loadMigrationsFrom(module_path('sports', 'Database/Migrations', 'app'), 'sports');
        $this->loadConfigsFrom(module_path('sports', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('sports', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
