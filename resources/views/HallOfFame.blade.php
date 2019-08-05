@extends('layouts.app')

@section('content')

<head>
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Lobster&display=swap" rel="stylesheet">
</head>

<div class="uk-section">
    <div class="uk-container uk-container-small uk-animation-kenburns ">


        <div class="GrandMasterItem">
            <svg class="crown uk-animation-slide-top-medium ">
                @php echo file_get_contents("images/crown.svg") @endphp
            </svg>
            <h1 class="caption glow">Pitch</h1>
            <span style="font-size: 60px;" class="flag-icon flag-icon-au"></span>
        </div>

        <div class="playersLeft">
            @for ($i = 0; $i < 4; $i++) <p>
                <span style="font-family: 'Bree Serif', serif;"><span class="flag-icon flag-icon-au flag-left"></span>
                    Grandmaster</span> Pitch <img width="50px" src="/images/grandmaster.png">
                </p>
                @endfor
        </div>

        <div class="playersRight">
            @for ($i = 0; $i < 4; $i++) <p>
                <span style="font-family: 'Bree Serif', serif;"><img width="50px" src="/images/grandmaster.png">
                    Grandmaster</span> Pitch <span class="flag-icon flag-icon-au flag-right">
                    </p>
                    @endfor
        </div>


    </div>
</div>





@endsection


<style>
    .GrandMasterItem {
        text-align: center;

    }

    .crown {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 150px;
        fill: goldenrod;
    }

    .caption {
        display: block;
        color: black;
        font-family: 'Merriweather', serif;
        font-family: 'Saira Stencil One', cursive;
    }

    .playersLeft {
        padding-top: 5vh;
        text-align: left;
        color: white;
        font-size: 30px;
        font-family: 'Lobster', cursive;
        float: left;
    }

    .playersRight {
        padding-top: 5vh;
        text-align: right;
        color: white;
        font-size: 30px;
        font-family: 'Lobster', cursive;
        float: right;
    }


    .flag-left {
        margin-right: 50px;
    }

    .flag-right {
        margin-left: 50px;
    }

    .glow {
        font-size: 60px;
        -webkit-animation: glow 1s ease-in-out infinite alternate;
        -moz-animation: glow 1s ease-in-out infinite alternate;
        animation: glow 1s ease-in-out infinite alternate;
    }

    @-webkit-keyframes glow {
        from {
            text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #F9D77E, 0 0 40px #F9D77E, 0 0 50px #F9D77E, 0 0 60px #F9D77E, 0 0 70px #F9D77E;
        }

        to {
            text-shadow: 0 0 20px #fff, 0 0 30px #F9D77E, 0 0 40px #F9D77E, 0 0 50px #F9D77E, 0 0 60px #F9D77E, 0 0 70px #F9D77E, 0 0 80px #F9D77E;
        }
    }
</style>