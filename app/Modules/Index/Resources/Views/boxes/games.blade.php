<div class="selected-sport-box contained"  style="background-image: url('{{ asset('images/e-sport.jpg') }}');">
    <div class="sport-box-overlay">
        <p>Football</p>
    </div>
</div>
@foreach($data as $datum)
    <div class="main-container-box">
        @if (!empty($sport))
            @php
            dd($sport);
            return;
            @endphp
            <div class="league-title">
            <div class="league-title-overlay">
                <p>{{$datum->title}}</p>
            </div>
            </div>

            @foreach ($datum->fixtures as $fixture)
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
        @else
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
        @endif

    </div>
@endforeach
