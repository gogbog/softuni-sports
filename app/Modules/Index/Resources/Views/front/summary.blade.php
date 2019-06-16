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


    <div class="main-content-container pl-lg-3 px-md-2 px-2 pr-lg-0">

        @foreach($sports as $sport)

            <a href="{{ route('sports.index',$sport->slug) }}" class="sport-main-link">
                <div class="sport-link-container"
                     @if (!empty($sport->getFirstMedia('stadium')))
                     style="background: url('{{ $sport->getFirstMedia('stadium')->getUrl() }}')"
                     @else
                     style="background: url('{{ asset('/img/soccer.jpg') }}')"
                        @endif
                >
                    <div class="sport-link-overlay">
                        <p> {{ $sport->title }} </p>
                    </div>
                </div>
            </a>

        @endforeach

    </div>

@endsection