@extends('layouts.app')
@section('content')

    <div class="side-bar-container">
        <div class="side-bar-inner">
            @foreach($sports_cache as $sport_cache)
                <div class="sport-collapsible-link">
                    <button class="collapsible-trigger"
                            type="button"
                            data-toggle="collapse"
                            data-target="#mobile_nav_{{ $sport_cache->id }}"
                            aria-expanded="false"
                            aria-controls="mobile_nav_{{$sport_cache->id}}">
                        {{$sport_cache->title}} <span class="badge">{{ $sport_cache->leagues_count }}</span>
                    </button>
                </div>

                <div class="collapse" id="mobile_nav_{{$sport_cache->id}}">
                    <div class="side-menu-leagues-container">
                        <div class="leagues-view-all">
                            <a href="{{ route('sports.index', $sport_cache->slug) }}" class="league-view-all-link">View all</a>
                        </div>
                        <ul class="leagues-list">
                            @foreach($sport_cache->leagues as $sport_cache_league)
                                <li class="league-item">
                                    <a href="{{ route('leagues.index', $sport_cache_league->slug) }}"
                                       class="league-link">{{ $sport_cache_league->title }} <span class="badge">{{ $sport_cache_league->fixtures_count }}</span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

<div class="container">
    <div class="match-view-bg-container">
        <img src="{{ asset('/images/soccer.jpg') }}" alt="" class="match-view-bg">
        <div class="match-view-bg-filter"></div>
        <div class="card sport-bg">
            <div class="card-header">
                <p class="match-date">{{ \Carbon\Carbon::parse($fixture->date)->format('d/m/Y')}}</p>
            </div>

            <div class="game-info-container">

                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-12">
                        <div class="view-team home-view-team">
                            <p>{{ $fixture->homeTeam }}</p>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-12">
                        <div class="view-result">
                            {{ $fixture->homeTeamScore }} : {{ $fixture->awayTeamScore }}
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12">
                        <div class="view-team away-view-team">
                            <p>{{ $fixture->enemyTeam }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="odds-table-container">

                <table class="table odds-table table-bordered">
                    <tr class="odds-table-header">
                        <th>Home Odds</th>
                        <th>Draw Odds</th>
                        <th>Away Odds</th>
                    </tr>
                    <tr>
                        <td>{{ $fixture->homeTeamOdds }}</td>
                        <td>{{ $fixture->drawOdds }}</td>
                        <td>{{ $fixture->awayTeamOdds }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="main-content-container">
            <div class="main-container-box">
                <div class="league-title">
                    <div class="league-title-overlay">
                        <p>Last matches from {{$fixture->league->title}}</p>
                    </div>
                </div>
                @foreach ($last_matches as $fixture)
                    <div class="match-card" style="z-index: 100">
                        <a href="{{ route('fixtures.index', $fixture->slug) }}" class="match-card-link">
                            <div class="team home-team">
                                <p>{{ $fixture->homeTeam }}</p>
                            </div>
                            <div class="result">
                                {{$fixture->homeTeamScore}} : {{$fixture->awayTeamScore}}
                            </div>
                            <div class="team away-team">
                                <p>{{ $fixture->enemyTeam }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


</div>


@endsection




