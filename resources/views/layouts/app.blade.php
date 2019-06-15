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

<nav id="menu">
    <header>
        <h2>Menu</h2>
        <input type="checkbox" id="theme-switch" class="theme-switch-input"/>
    </header>
</nav>

<main id="panel">
{{--    <div class="owl-carousel sport-card-slider">--}}
{{--        <div class="item"><h4>1</h4></div>--}}
{{--        <div class="item"><h4>2</h4></div>--}}
{{--        <div class="item"><h4>3</h4></div>--}}
{{--        <div class="item"><h4>4</h4></div>--}}
{{--        <div class="item"><h4>5</h4></div>--}}
{{--    </div>--}}
    <div class="view-wrapper width-view-max">
        @yield('content')
    </div>
</main>

{{--Bottom navigationa--}}
{{--TUKA SLAGASH FOOTERA--}}

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>


