@extends('layouts.app')
@section('content')

    <div class="side-bar-container">

        <div class="side-bar-inner">

            <div class="sport-collapsible-link">
                <button class="collapsible-trigger"
                        type="button"
                        data-toggle="collapse"
                        data-target="#sportLeagues"
                        aria-expanded="false"
                        aria-controls="sportLeagues">
                    Sport Name <span class="badge">4</span>
                </button>
            </div>

            <div class="collapse" id="sportLeagues">
                <div class="side-menu-leagues-container">
                    <a href="#" class="league-view-all">View all</a>
                    <ul class="leagues-list">
                        <li class="league-item">
                            <a href="#" class="league-link">Premier League</a>
                        </li>
                        <li class="league-item">
                            <a href="#" class="league-link">Premier League</a>
                        </li>
                        <li class="league-item">
                            <a href="#" class="league-link">Premier League</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="sport-collapsible-link">
                <button class="collapsible-trigger"
                        type="button"
                        data-toggle="collapse"
                        data-target="#sportLeagues1"
                        aria-expanded="false"
                        aria-controls="sportLeagues1">
                    Sport Name <span class="badge">4</span>
                </button>
            </div>

            <div class="collapse" id="sportLeagues1">
                <div class="side-menu-leagues-container">
                    <a href="#" class="league-view-all">View all</a>
                    <ul class="leagues-list">
                        <li class="league-item">
                            <a href="#" class="league-link">Premier League</a>
                        </li>
                        <li class="league-item">
                            <a href="#" class="league-link">Premier League</a>
                        </li>
                        <li class="league-item">
                            <a href="#" class="league-link">Premier League</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </div>


    <div class="main-content-container pl-lg-3 px-md-2 px-2 pr-lg-0">

        @include('index::boxes.games')

    </div>

@endsection