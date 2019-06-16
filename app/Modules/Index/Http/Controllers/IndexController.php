<?php

namespace App\Modules\Index\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Fixtures\Models\Fixture;
use App\Modules\Leagues\Models\League;
use App\Modules\Sports\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use function Schnittstabil\JsonDecodeFile\jsonDecodeFile;
use Sportmonks\SoccerAPI\Facades\SoccerAPI;

class IndexController extends Controller
{
    public function index()
    {
        $sports = Sport::active()->get();
        return view('index::front.summary', compact('sports'));
    }

    public function search(Request $request)
    {
        $word = $request->get('word');

        $sport = Sport::active()->where('title', 'LIKE', '%'. $word . '%')->with(['leagues', 'leagues.fixtures'])->first();

        if ($sport) {
            $leagues = $sport->leagues->paginate(3);

            return view('index::front.index', compact('sport', 'leagues'));
        }

        $leagues = League::active()->with(['fixtures'])->where('title', 'LIKE', '%'. $word . '%')->get();

        if (!empty($leagues) && $leagues->isNotEmpty()) {
            $sport = new Sport();
            $sport->title = 'Searching for: ' . $word;

            $leagues = $leagues->paginate(3);

            return view('index::front.index', compact('sport', 'leagues'));
        }

        $matches = Fixture::active()->where('title', 'LIKE', '%'. $word . '%')->paginate(20);

        if (!empty($matches) && $matches->isNotEmpty()) {
            $data = $matches;

            $sport = new Sport();
            $sport->title = 'Searching for: ' . $word;

            return view('index::front.index', compact('sport', 'data'));
        }

        $sport = new Sport();
        $sport->title = 'Searching for: ' . $word;
        $data = new Collection();
        $data = $data->paginate();
        return view('index::front.index', compact('sport', 'data'));

        }

    public function test()
    {
        $path = storage_path('data/sport-events.json');
        $wtf = jsonDecodeFile($path) ;
        dd($wtf[12]);
    }
}
