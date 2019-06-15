<?php

namespace App\Modules\Sports;

use App\Modules\Countries\Http\Controllers\Admin\CountriesController;
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
        Route::resource('sports', SportsController::class);
    }

    public function menu($menu)
    {
        $menu->add(trans('sports::admin.module_name'), ['url' => \Charlotte\Administration\Helpers\Administration::route('sports.index'), 'icon' => ' ti-medall'])->nickname('sports_module');

//        $menu->get('sports_module')->add(trans('administration::admin.add'), ['url' => \Charlotte\Administration\Helpers\Administration::route('sports.create')]);
//        $menu->get('sports_module')->add(trans('administration::admin.view_all'), ['url' => \Charlotte\Administration\Helpers\Administration::route('sports.index')]);



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