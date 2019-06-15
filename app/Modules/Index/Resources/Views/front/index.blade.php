@extends('layouts.app')
@section('content')

    <div class="side-bar-container">

        <div class="sport-collapsible-link">
            <button class="collapsible-trigger"
                    type="button"
                    data-toggle="collapse"
                    data-target="#sportLeagues"
                    aria-expanded="false"
                    aria-controls="sportLeagues">
                Sport Name
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
                Sport Name
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

    <div class="main-content-container px-lg-3 px-md-2 px-2">
        <div class="match-card">
            <a href="#" class="match-card-link">
                <div class="team home-team">
                    <p>Chealsea</p>
                </div>
                <div class="result">
                    1 : 0
                </div>
                <div class="team away-team">
                    <p>Manchester City</p>
                </div>
            </a>
        </div>

        <div class="match-card">
            <a href="#" class="match-card-link">
                <div class="team home-team">
                    <p>Chealsea</p>
                </div>
                <div class="result">
                    1 : 0
                </div>
                <div class="team away-team">
                    <p>Manchester City</p>
                </div>
            </a>
        </div>

        <div class="match-card">
            <a href="#" class="match-card-link">
                <div class="team home-team">
                    <p>Chealsea</p>
                </div>
                <div class="result">
                    1 : 0
                </div>
                <div class="team away-team">
                    <p>Manchester City</p>
                </div>
            </a>
        </div>

    </div>

@endsection