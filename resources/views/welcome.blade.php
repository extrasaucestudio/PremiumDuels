@include('layouts.app')
@extends('layouts.headers')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>



<body>

    <div id="cos" class="uk-container">





        <form style=" width: 50%;" class="uk-search uk-search-default searchPlayers">
            <input autocomplete="off" style="background-color: white;" type="text" name="user_name" id="user_name"
                class="uk-search-input autocomplete" type="search" placeholder="Search for user...">


            <div id="UserList"></div>
        </form>


        <div class="uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-animation-scale-up">
                    <h3 class="uk-card-title">Players Registered</h3>
                    <p id="PlayersNum">{{$users->count()}}</p>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-primary uk-card-body uk-animation-scale-up">
                    <h3 class="uk-card-title">FT7 Finished</h3>
                    <p id="DuelsNum">{{$duels->count()}}</p>
                </div>
            </div>
            <div>
                <div class="uk-card uk-card-secondary uk-card-body uk-animation-scale-up">
                    <h3 class="uk-card-title">Online</h3>
                    <p>{{$serverData[5]}}/{{$serverData[6]}}</p>
                </div>
            </div>
        </div>

        <ul class="uk-list uk-container uk-container-xsmall latest_duels uk-animation-slide-right-medium"
            style="text-align: center">
            <h1 class="myH1">Latest Duels</h1>
            <li>
                @foreach ($duels->take(3) as $duel)
                <h1 style="color: #FFFF40" style="    overflow: hidden;
                white-space: nowrap;">
                    <div href="#" class="duel_winner"><span style="margin-right: 25px"
                            class="flag-icon flag-icon-{{$duel->Duel_winner->country_code}}"></span><a
                            href="/user/{{$duel->Duel_winner->uid}}">{{$duel->Duel_winner->name}}</a>
                    </div><img src="images/vs.png" class="vsIcon">
                    <div href="#" class=" duel_loser"><a href="/user/{{$duel->Duel_loser->uid}}">
                            {{$duel->Duel_loser->name}}</a><span style="margin-left: 25px"
                            class="flag-icon flag-icon-{{$duel->Duel_loser->country_code}}"></span></div>
                </h1>
                @endforeach

            </li>

        </ul>

        <div class="leaderboard">
            <h1 class="myH1">Leaderboard</h1>
            <table style=" background-color: white" class=" uk-table uk-table-hover uk-table-divider ">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th> Title </th>
                        <th>ELO</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                    <tr class="uk-animation-scale-up">
                        <td><a href="/user/{{$user->uid}}">{{$user->name}} <span
                                    class="flag-icon flag-icon-{{$user->country_code}}"></span></a></td>
                        <td>{{$user->Title->name}} &nbsp <img class="rank_img_leaderboard"
                                src="{{$user->Title->image}}"> </td>
                        <td>{{$user->elo}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        .searchPlayers {
            padding-top: 30vh;
            margin-top: 0%;
            left: 50%;
            top: 50%;
            position: absolute;
            display: inline-block;
            -webkit-transform: translate3d(-50%, -50%, 0);
            -moz-transform: translate3d(-50%, -50%, 0);
            transform: translate3d(-50%, -50%, 0);
        }
    </style>


</body>

</html>

<script>
    $(document).ready(function(){
        
         $('#user_name').keyup(function(){ 
            $( "#UserList" ).empty();
                var query = $(this).val();
                
                if(query != '')
                {
                 var _token = $('input[name="_token"]').val();
                 $.ajax({
                  url:"{{ route('autocomplete') }}",
                  method:"get",
                  data:{query:query, _token:_token},
                  success:function(data){
                   $('#UserList').fadeIn();  
                   if(data == 1) return
                            $('#UserList').html(data);
                  }
                 });
                }
            });
        
            $(document).on('click', 'li', function(){  
                $('#user_name').val($(this).text());  
                $('#UserList').fadeOut();  
            });  
        
        });

        $("#user_name").keyup(function(e) {
   switch (e.keyCode) {
      case 8: 
      $( "#UserList" ).empty();
         break;
   }
});



    function animateValue(id, start, end, duration) {
        if(end == 0) return
        var range = end - start;
        var current = start;
        var increment = end > start ? 1 : -1;
        var stepTime = Math.abs(Math.floor(duration / range));
        var obj = document.getElementById(id);
        var timer = setInterval(function () {
            current += increment;
            obj.innerHTML = current;
            if (current == end) {
                clearInterval(timer);
            }
        }, stepTime);
    }

    animateValue("PlayersNum", 0, {{$users->count()}}, 200);

animateValue("DuelsNum", 0, {{$duels->count()}}, 200);

$('.searchPlayers').val('');

</script>