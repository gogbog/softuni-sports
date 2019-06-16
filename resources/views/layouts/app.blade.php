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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
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

    {{-- website logo --}}
    <div class="main-top-navbar-logo">
        <img src="{{ asset("images/softuni_logo.png") }}">
    </div>

    <div class="main-top-phantom"></div>

    {{-- search form --}}
    <div class="main-top-navbar-search-form">
        <form class="search-form" action="" id="search_form">
            <input class="search-form-input" id="search_form_input" type="search" placeholder="search for sport, league or match">
            <i class="fa fa-search search-form-icon"></i>
        </form>

        <form action="" class="search-form-mobile" id="search_form_mobile">

            <i class="fa fa-search search-form-icon"></i>
        </form>
    </div>

    {{-- theme switcher --}}
    <div class="main-top-navbar-theme-switcher">
        <input class="switch_input theme-switch-input" type="checkbox" id="theme-switch">
        <label aria-hidden="true" class="switch_label" for="theme-switch">On</label>
        <div aria-hidden="true" class="switch_marker"></div>
    </div>

    <input class="search-form-input_mobile" id="search_form_input_mobile" type="search" placeholder="search for sport, league or match">
</nav>

<nav id="menu">
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
    <div class="selected-sport-box contained"  style="background-image: url('{{ asset('images/e-sport.jpg') }}');">
        <div class="sport-box-overlay">
            <p>Football</p>
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


