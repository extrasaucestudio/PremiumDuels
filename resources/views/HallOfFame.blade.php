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
    html,
    body {
        background:
            /* top, transparent black, faked with gradient */
            linear-gradient(rgba(0, 0, 0, 0.7),
            rgba(0, 0, 0, 0.7)),

            url('/images/bg_hall.jpg') !important;
    }
</style>