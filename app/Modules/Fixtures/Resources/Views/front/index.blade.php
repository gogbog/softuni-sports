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
                            <a href="{{ route('sports.index', $sport_cache->slug) }}" class="league-view-all-link">View
                                all</a>
                        </div>
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

    <div class="container">
        <div class="match-view-bg-container">
            @if (!empty($fixture->league->sport->getFirstMedia('stadium')))
                <img src="{{ $fixture->league->sport->getFirstMedia('stadium')->getUrl() }}" alt=""
                     class="match-view-bg">
            @else
                <img src="{{ asset('/images/soccer.jpg') }}" alt="" class="match-view-bg">

            @endif
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
                    <div class="odd-switch-container">
                        <p class="decimal">Decimal Odds</p>
                        <div class="main-top-navbar-theme-switcher">
                            <input class="switch_input odd-switch-input"
                                   type="checkbox"
                                   id="odds-switch">
                            <label aria-hidden="true" class="switch_label" for="odds-switch">On</label>
                            <div aria-hidden="true" class="switch_marker"></div>
                        </div>
                        <p class="american">American Odds</p>
                    </div>


                    <span class="d-none" id="homeOdds">{{ $fixture->homeTeamOdds }}</span>
                    <span class="d-none" id="drawOdds">{{ $fixture->drawOdds }}</span>
                    <span class="d-none" id="awayOdds">{{ $fixture->awayTeamOdds }}</span>
                    <span class="d-none" id="cookie-status">@if (!empty($_COOKIE['odd']) && $_COOKIE['odd'] == 'american')T@else F @endif</span>

                    <table class="table odds-table table-bordered">
                        <tr class="odds-table-header">
                            <th>Home Odds</th>
                            <th>Draw Odds</th>
                            <th>Away Odds</th>
                        </tr>
                        <tr>
                            <td data-odd="decimal" id="tableHomeTD">{{ change_format($fixture->homeTeamOdds) }}</td>
                            <td data-odd="decimal" id="tableDrawTD">{{ change_format($fixture->drawOdds) }}</td>
                            <td data-odd="decimal" id="tableAwayTD">{{ change_format($fixture->awayTeamOdds) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if ($last_matches->isNotEmpty())
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
                @endif
        </div>


    </div>


@endsection




