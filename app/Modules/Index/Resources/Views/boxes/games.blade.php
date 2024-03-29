@php
    $media = null;
    if (!empty($sport) && !empty($sport->getFirstMedia('stadium'))) {
        $media = $sport->getFirstMedia('stadium')->getUrl();
    }

    if (!empty($league) && !empty($league->sport->getFirstMedia('stadium'))) {
            $media = $league->sport->getFirstMedia('stadium')->getUrl();
    }
@endphp
<div class="selected-sport-box contained" @if (!empty($media)) style="background-image: url('{{$media}}');" @else style="background-image: url('{{ asset('images/e-sport.jpg') }}');" @endif>
    <div class="sport-box-overlay">
        <p>@if (!empty($league)) {{ $league->title }} @else {{ $sport->title }} @endif</p>
    </div>
</div>
@if (!empty($leagues) && $leagues->isNotEmpty())
    @foreach($leagues as $league)
        <div class="main-container-box">
                <div class="league-title">
                    <div class="league-title-overlay">
                        <p>{{$league->title}}</p>
                    </div>
                </div>

                @foreach ($league->fixtures as $fixture)
                    <div class="match-card">
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
                @endforeach</div>
    @endforeach
    {{ $leagues->links('particals.breadcrumbs') }}

@else
    <div class="main-container-box">
        @foreach ($data as $fixture)
            <div class="match-card">
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
        {{ $data->links('particals.breadcrumbs') }}
    </div>
@endif

