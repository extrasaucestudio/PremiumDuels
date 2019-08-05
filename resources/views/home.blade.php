@extends('layouts.app')

@section('content')


<div class="uk-section">
    <div class="uk-container ">

        <div class="uk-card uk-card-primary home uk-card-body  uk-align-center">

            <br>


            <div class="stats uk-container-small uk-container">
                <h1 @if($user->golden_account == true)class="golden_account" @endif style="text-align: center;
                    color: black;font-family: 'Merriweather', serif;"">
                    {{$user->name}} <span style=" margin-left: 25px"
                        class="flag-icon flag-icon-{{$user->country_code}}"></span> <br>
                    @if($user->special_title_id != null)

                    <br>
                    <b> <span
                            style="font-family: 'Merriweather', serif;">{{$user->SpecialTitle->SpecialTitleData->name}}</span></b>
                    @endif
                </h1>

                <br>

                <p style="color: black; text-align: center"> @auth
                    @if($WonAgainst != -1 && $LostAgainst != -1 && $user->uid != Auth::user()->uid)
                    <b style="color: orange">You</b> {{ $WonAgainst}} : {{$LostAgainst}} {{$user->name}}
                    @endif
                    @endauth
                    <br>
                    <br>
                    <br>
                </p>

                @if (\Request::is('home') && $user->SpecialTitles->count() > 0)


                <div class="uk-form-select" data-uk-form-select>

                    <form action="/api/title/change" method="POST">
                        {{ csrf_field() }}
                        <select name="title" id="Titles" onchange="this.form.submit()">
                            <option value="none">Blank</option>
                            @foreach ($user->SpecialTitles as $item)

                            <option value="{{$item->id}}">{{$item->SpecialTitleData->name}}</option>

                            @endforeach


                        </select>
                    </form>


                </div>


                @endif



                <dl class="uk-description-list uk-description-list-divider">

                    <dt>Kills: <b>{{$user->kills}}</b></dt>
                    <dd class="underDesc">Number of kills collected in FT7 Duels.</dd>
                    <dt>Deaths: <b>{{$user->deaths}}</b></dt>
                    <dd class="underDesc">Number of deaths in FT7 Duels.</dd>
                    <dt>Duels Played: <b>{{$duels}}</b></dt>
                    <dd class="underDesc">Total ammount of played FT7 duels.</dd>
                    <dt>Duels Won: <b>{{$user->DuelsWon->count()}}</b></dt>
                    <dd class="underDesc">Total ammount of winned FT7 duels.</dd>
                    <dt>WinRatio: <b>{{$winratio}}</b></dt>
                    <dd class="underDesc">The ratio of winnings to losses in percents.</dd>
                    <dt>ELO: <b>{{$user->elo}}</b></dt>
                    <dd class="underDesc">Your ranking points calculated by our system.</dd>
                </dl>

            </div>

            <br>
            <h1 style="text-align: center; font-family: 'Merriweather', serif; color: black">Next Rank:
                @if(!is_object($nextRank)) None @else
                {{$nextRank->name}} @endif
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
            <br>

            <div class="stats uk-container-xsmall uk-container">

                <br>
                <h1 style="font-family: 'Merriweather', serif; color: black" class="myH1">Latest Duels</h1>

                <table class="uk-table uk-table-hover uk-table-divider" style="color: black">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th></th>
                            <th></th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($LastDuels->take(5) as $duel)

                        <tr @if($duel->Duel_loser->id == $user->id) style="background-color: rgba(255, 0, 0, 0.89)"
                            @else
                            style="background-color: rgba(0,100,0 ,0.90 )" @endif>

                            <td><span style="padding-right: 50px"
                                    class="flag-icon latestDuelFlag flag-icon-{{$duel->Duel_winner->country_code}}"></span>
                                <a @if($duel->Duel_winner->golden_account == true) class="golden_account" @endif
                                    href="/user/{{$duel->Duel_winner->uid}}"> {{$duel->Duel_winner->name}}</a> <img
                                    class="rank_img_leaderboard latestDuelElo"
                                    src="{{$duel->Duel_winner->Title->image}}"> </td>
                            <td>{{$duel->winner_score}}<span class="latestDuelElo" style="color: white">
                                    (+{{$duel->winner_elo_plus}})</span>
                            </td>
                            <td>{{$duel->loser_score}} <span class="latestDuelElo"
                                    style="color:white">({{$duel->loser_elo_minus}})</span>
                            </td>
                            <td style="float: right"> <span style="padding-right: 50px"
                                    class="flag-icon latestDuelFlag flag-icon-{{$duel->Duel_loser->country_code}}">
                                </span> <a @if($duel->Duel_loser->golden_account == true) class="golden_account" @endif
                                    href="/user/{{$duel->Duel_loser->uid}}">{{$duel->Duel_loser->name}} </a><img
                                    class="rank_img_leaderboard latestDuelElo"
                                    src="{{$duel->Duel_winner->Title->image}}"></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>


</div>


<script>
    SelectElement("Titles", {{$user->special_title_id}})

function SelectElement(id, valueToSelect)
{    
    if(valueToSelect == null) valueToSelect = 'none';
    var element = document.getElementById(id);
    element.value = valueToSelect;
}

</script>



@endsection