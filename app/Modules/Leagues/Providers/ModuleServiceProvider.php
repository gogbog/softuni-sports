<?php

namespace App\Modules\Leagues\Providers;

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
        $this->loadTranslationsFrom(module_path('leagues', 'Resources/Lang', 'app'), 'leagues');
        $this->loadViewsFrom(module_path('leagues', 'Resources/Views', 'app'), 'leagues');
        $this->loadMigrationsFrom(module_path('leagues', 'Database/Migrations', 'app'), 'leagues');
        $this->loadConfigsFrom(module_path('leagues', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('leagues', 'Database/Factories', 'app'));
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
