<?php

namespace App\Modules\Leagues\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Leagues\Models\League;

class LeaguesController extends Controller {
    public function index($slug) {
        $league = League::active()->with(['fixtures'])->where('slug', $slug)->first();

        if (empty($league)) {
            abort(404);
        }

        $data = $league->fixtures;


        return view('index::front.index', compact('league', 'data'));
    }
}
