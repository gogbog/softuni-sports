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


</nav>

<main id="panel">
    <div class="view-wrapper contained">
        @yield('content')
    </div>
</main>

{{--Bottom navigationa--}}
{{--TUKA SLAGASH FOOTERA--}}

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>


