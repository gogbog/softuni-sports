<?php

namespace App\Modules\Sports\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Sports\Models\Sport;

class SportController extends Controller {

    public function index($slug) {

        $sport = Sport::active()->where('slug', $slug)->with(['leagues', 'leagues.fixtures'])->first();

        if (empty($sport)) {
            abort(404);
        }

        $leagues = $sport->leagues->paginate(3);

        return view('index::front.index', compact('sport', 'leagues'));
    }

}
