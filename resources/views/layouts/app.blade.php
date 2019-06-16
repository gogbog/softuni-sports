@php
    $isDarkTheme = true;
    if ( !empty($_COOKIE['dark']) && $_COOKIE['dark'] == 'true' ) {
        $isDarkTheme = true;
    } else if ( !empty($_COOKIE['dark']) && $_COOKIE['dark'] == 'false' ) {
        $isDarkTheme = false;
    } else if ( empty($_COOKIE['dark']) ) {
        $isDarkTheme = false;
        Cookie::make('dark', true);
    }

@endphp
<!doctype html>
<html lang="{{ app()->getLocale() }}" data-theme="{{ $isDarkTheme ? 'dark' : 'light' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SoftUniSports') }}</title>
    {{--    <link rel="icon" href="{{ asset('img/dark-logo.png') }}">--}}
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>

{{--ILIIKA TUKA SLAGASH NAVBARA--}}
<nav class="main-top-navbar">

    {{-- sidebar toggler button --}}
    <div class="main-top-navbar-sidebar-toggle-btn" id="top-navbar-sidebar-toggler">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>

    <div class="contained">

        {{-- website logo --}}
        <div class="main-top-navbar-logo">
            {{--<img src="#">--}}
            <h3>SOFTUNI FEST 2019</h3>
        </div>

        {{-- search form --}}
        <div class="main-top-navbar-search-form">

        </div>

        {{-- theme toggler --}}
        <div class="main-top-navbar-theme-switcher">
            <input type="checkbox" id="theme-switch" class="theme-switch-input"/>
        </div>

    </div>
</nav>

<nav id="menu">
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

</nav>

<main id="panel">
    <div class="other-sports-games" data-slideout-ignore>
        <div class="owl-carousel other-sports-games-carousel">

            <div class="card">
                <a href="" class="recent-link">
                    <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <div class="game-info">
                            <div class="card-team card-home-team">
                                Chelsea
                            </div>
                            <div class="card-result">
                                1 : 0
                            </div>
                            <div class="card-team card-home-team">
                                Manchester city
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
    <div class="view-wrapper contained">
        @yield('content')
    </div>
</main>

{{--Bottom navigationa--}}
{{--TUKA SLAGASH FOOTERA--}}

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>


