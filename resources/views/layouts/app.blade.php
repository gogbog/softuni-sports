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

    $info = true;
    if ( !empty($_COOKIE['info']) && $_COOKIE['info'] == 'true' ) {
        $info = true;
    } else if ( !empty($_COOKIE['info']) && $_COOKIE['info'] == 'false' ) {
        $info = false;
    } else if ( empty($_COOKIE['info']) ) {
        $info = true;
        Cookie::make('info', true);
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
        <a href="{{ route('index.index') }}">
            <img src="{{ asset("images/softuni_logo.png") }}">
        </a>
    </div>

    <div class="main-top-phantom"></div>

    {{-- search form --}}
    <div class="main-top-navbar-search-form">
        <form class="search-form"
              action="{{ route('index.search') }}"
              method="get"
              id="search_form">
            <input class="search-form-input"
                   id="search_form_input"
                   type="search"
                   name="word"
                   placeholder="Search ...">

            <i class="fa fa-search search-form-icon"></i>
        </form>

    </div>

    {{-- theme switcher --}}
    <div class="main-top-navbar-theme-switcher">
        <input class="switch_input theme-switch-input" type="checkbox" id="theme-switch">
        <label aria-hidden="true" class="switch_label" for="theme-switch">On</label>
        <div aria-hidden="true" class="switch_marker"></div>
    </div>

</nav>

<nav id="menu">
    <div class="side-bar-container" id="mobile-side">

        <div class="side-bar-inner">
            @foreach($sports_cache as $sport_cache)
                <div class="sport-collapsible-link">
                    <button class="collapsible-trigger"
                            type="button"
                            data-toggle="collapse"
                            data-target="#mobile_nav_{{ $sport_cache->id }}"
                            aria-expanded="false"
                            aria-controls="mobile_nav_{{$sport_cache->id}}">
                        {{$sport_cache->title}} <span class="badge">4</span>
                    </button>
                </div>

                <div class="collapse" id="mobile_nav_{{$sport_cache->id}}">
                    <div class="side-menu-leagues-container">
                        <a href="{{ route('sports.index', $sport_cache->slug) }}" class="league-view-all">View all</a>
                        <ul class="leagues-list">
                            @foreach($sport_cache->leagues as $sport_cache_league)
                                <li class="league-item">
                                    <a href="{{ route('leagues.index', $sport_cache_league->slug) }}"
                                       class="league-link">{{ $sport_cache_league->title }} <span
                                                class="badge">{{ $sport_cache_league->fixtures_count }}</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</nav>

<main id="panel">
    <div class="other-sports-games" data-slideout-ignore>
        <div class="owl-carousel other-sports-games-carousel">
            @foreach($fixtures_cache as $fixture_cache)
                <div class="card">
                    <a href="{{ route('fixtures.index', $fixture_cache->slug) }}" class="recent-link">
                        @if (!empty($fixture_cache->league->sport) && !empty($fixture_cache->league->sport->getFirstMedia('stadium')))
                            <img src="{{ $fixture_cache->league->sport->getFirstMedia('stadium')->getUrl() }}"
                                 class="card-img" alt="...">
                        @endif
                        <div class="card-img-overlay">
                            <div class="game-info">
                                <div class="card-team card-home-team">
                                    {{ $fixture_cache->homeTeam }}
                                </div>
                                <div class="card-result">
                                    {{$fixture_cache->homeTeamScore}} : {{$fixture_cache->awayTeamScore}}
                                </div>
                                <div class="card-team card-home-team">
                                    {{ $fixture_cache->enemyTeam }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
    <div class="view-wrapper contained">
        @yield('content')
    </div>



    {{--Bottom navigationa--}}
    {{--TUKA SLAGASH FOOTERA--}}
    <footer class="main-bottom-footer">

        <div class="main-bottom-footer-separator"></div>

        <div class="main-bottom-footer-logo">
            <a href="{{ route('index.index') }}">
                <img src="{{ asset("images/softuni_logo.png") }}">
            </a>
        </div>

        <div class="main-bottom-footer-text">
            <p>A simple Sports Trading Platform solution created for the SoftUni Fest 2019 by:</p>
        </div>

        <div class="main-bottom-footer-credits">
            <ul>
                <li>George Dimitrov</li>
                <li>Deyan Bozhilov</li>
                <li>Ilia Baroff</li>
            </ul>
        </div>

        <div class="main-bottom-footer-separator"></div>

    </footer>
</main>

<!-- Button trigger modal -->

<button type="button"
        class="btn btn-primary info-modal-trigger"
        onclick="openModal()">
    <i class="fas fa-info"></i>
</button>
<!-- Modal -->
<div class="modal-cust {{ $info ? '' : 'destroyed' }}"
     id="exampleModalCenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Log in to our Admin Panel</h5>
                <button type="button" class="close" onclick="closeModal()">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Здравейте, ние сме Code Ravers.
                <br><br>Това е нашия проект за Softuni Fest 2019.
                <br>Ако искате да влезне в администрацията:
                <br>
                username : <strong>softuni@abv.bg</strong>
                <br>
                password : <strong>softuni</strong>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="{{ url('/admin') }}">Go to Admin Panel</a>
            </div>
        </div>
    </div>
</div>



<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>


