<?php

namespace App\Modules\Index\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Sportmonks\SoccerAPI\Facades\SoccerAPI;

class IndexController extends Controller
{
    public function index()
    {
        return view('index::front.index');
    }

    public function view()
    {
        return view('view');
    }

    public function test()
    {
        dd('test');
    }
}
