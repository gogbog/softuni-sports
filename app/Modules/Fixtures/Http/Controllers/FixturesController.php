<?php

namespace App\Modules\Fixtures\Http\Controllers;

use App\Modules\Fixtures\Models\Fixture;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class FixturesController extends Controller
{
    public function index($slug) {

        $fixture = Fixture::active()->with(['league', 'league.sport'])->where('slug', $slug)->first();

        if (empty($fixture)) {
            abort(404);
        }


        return view('fixtures::front.index', compact('fixture'));
    }
}
