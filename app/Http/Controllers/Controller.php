<?php

namespace App\Http\Controllers;

use App\Modules\Fixtures\Models\Fixture;
use App\Modules\Sports\Models\Sport;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {


        $sports = Cache::remember('sports_cache', 9000, function () {
            return Sport::active()->with(['leagues' => function ($q) {
                $q->withCount('fixtures');
            }])->withCount(['leagues'])->get();
        });

        View::share('sports_cache', $sports);


        $fixtures_cache = Fixture::active()->orderBy('date', 'DESC')->with(['league', 'league.sport'])->limit(15)->get();
        View::share('fixtures_cache', $fixtures_cache);

    }
}
