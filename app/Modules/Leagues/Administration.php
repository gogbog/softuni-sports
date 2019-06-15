<?php

namespace App\Modules\Leagues;

use App\Modules\Countries\Http\Controllers\Admin\CountriesController;
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
        Route::resource('leagues', LeaguesController::class);
    }

    public function menu($menu)
    {
        $menu->add(trans('leagues::admin.module_name'), ['url' => \Charlotte\Administration\Helpers\Administration::route('leagues.index'), 'icon' => 'ti-crown'])->nickname('leagues_module');

//        $menu->get('leagues_module')->add(trans('administration::admin.add'), ['url' => \Charlotte\Administration\Helpers\Administration::route('leagues.create')]);
//        $menu->get('leagues_module')->add(trans('administration::admin.view_all'), ['url' => \Charlotte\Administration\Helpers\Administration::route('leagues.index')]);



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