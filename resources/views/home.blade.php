@extends('layouts.app')

@section('content')


<div class="uk-section">
    <div class="uk-container ">

        <div class="uk-card uk-card-primary home uk-card-body  uk-align-center">

            <br>

            <div class="stats uk-container-small uk-container">
                <dl class="uk-description-list uk-description-list-divider">
                    <dt>Kills: <b>{{$user->kills}}</b></dt>
                    <dd>Number of kills collected in FT7 Duels.</dd>
                    <dt>Deaths: <b>{{$user->deaths}}</b></dt>
                    <dd>Number of deaths in FT7 Duels.</dd>
                    <dt>Duels Played: <b>{{$duels}}</b></dt>
                    <dd>Total ammount of played FT7 duels.</dd>
                    <dt>Duels Won: <b>{{$user->DuelsWon->count()}}</b></dt>
                    <dd>Total ammount of winned FT7 duels.</dd>
                    <dt>WinRatio: <b>{{$winratio}}</b></dt>
                    <dd>The ratio of winnings to losses in percents.</dd>
                    <dt>ELO: <b>{{$user->elo}}</b></dt>
                    <dd>Your ranking points calculated by our system.</dd>
                </dl>

            </div>

            <br>
            <h1 style="text-align: center">Next Rank: @if(!is_object($nextRank)) None @else {{$nextRank->name}} @endif
                @if(is_object($nextRank))
                <img style=" width: 85px;
                float: center;" src="{{$nextRank->image}}"></h1>
            <progress id="js-progressbar" class="uk-progress" value="{{$user->elo}}"
                max="{{$nextRank->elo}}"></progress>
            @endif
            </h1>


            <div class="uk-child-width-1-2@s uk-grid-match" uk-grid>
                <div>
                    <div class="uk-card   uk-card-primary uk-card-hover uk-card-body">
                        <h3 class="uk-card-title">Ranking</h3>
                        <p>You are currently {{$rank}}th in the ranking.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-primary uk-card-hover uk-card-body">
                        <h3 class="uk-card-title">ELO Rating</h3>
                        <p>Your current elo is equal to {{$user->elo}}.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-primary uk-card-hover uk-card-body uk-light">
                        <h3 class="uk-card-title">{{$user->Title->name}} <img class="rank_img_leaderboard"
                                src="{{$user->Title->image}}"></h3>
                        <p>Your current rank.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-primary uk-card-hover uk-card-body uk-light">
                        <h3 class="uk-card-title">Last seen</h3>
                        <p>{{$user->updated_at}}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>




@endsection