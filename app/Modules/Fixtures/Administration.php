<?php

namespace App\Modules\Fixtures;

use App\Modules\Countries\Http\Controllers\Admin\CountriesController;
use App\Modules\Fixtures\Http\Controllers\Admin\FixturesController;
use App\Modules\Leagues\Http\Controllers\Admin\LeaguesController;
use App\Modules\Sports\Http\Controllers\Admin\SportsController;
use Charlotte\Administration\Interfaces\Structure;
use Illuminate\Support\Facades\Route;

class Administration implements Structure
{

    public function dashboard()
    {
        // TODO: Implement dashboard() method.
    }

    public function routes()
    {
        Route::resource('fixtures', FixturesController::class);
    }

    public function menu($menu)
    {
        $menu->add(trans('fixtures::admin.module_name'), ['url' => \Charlotte\Administration\Helpers\Administration::route('fixtures.index'), 'icon' => 'ti-quote-right'])->nickname('fixtures_module');
    }

    public function settings($module, $form, $form_model)
    {
        $form->add($module . '_title', 'text', [
            'title' => trans('countries::admin.title'),
            'translate' => true,
            'model' => $form_model
        ]);
    }
}