<?php

namespace App\Modules\Fixtures\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class FixturesController extends Controller
{
    public function index() {
        return view('fixtures::front.index');
    }
}
