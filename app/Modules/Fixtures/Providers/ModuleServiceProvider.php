<?php

namespace App\Modules\Fixtures\Providers;

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
        $this->loadTranslationsFrom(module_path('fixtures', 'Resources/Lang', 'app'), 'fixtures');
        $this->loadViewsFrom(module_path('fixtures', 'Resources/Views', 'app'), 'fixtures');
        $this->loadMigrationsFrom(module_path('fixtures', 'Database/Migrations', 'app'), 'fixtures');
        $this->loadConfigsFrom(module_path('fixtures', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('fixtures', 'Database/Factories', 'app'));
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
