<?php

namespace App\Modules\Fixtures\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Fixtures\Models\Fixture;

class FixturesController extends Controller {
    public function index($slug) {

        $fixture = Fixture::active()->with(['league', 'league.sport'])->where('slug', $slug)->first();

        if (empty($fixture)) {
            abort(404);
        }

        $last_matches = Fixture::active()->where('league_api_id', $fixture->league_api_id)->where('id', '!=', $fixture->id)->orderByDesc('date')->limit(10)->get();

        return view('fixtures::front.index', compact('fixture', 'last_matches'));
    }
}
