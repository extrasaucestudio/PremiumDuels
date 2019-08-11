@extends('layouts.app')

@section('content')

<head>
    <link href="https://fonts.googleapis.com/css?family=Lexend+Peta&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Acme&display=swap" rel="stylesheet">
</head>

<div class="uk-section">
    <div class="uk-container uk-container-small ">



        <div class="tournament">
            <h1 class="tournament-title ">
                {{$tournament->title}}</h1>
            <p class="tournament-author"><a class="uk-link-reset" @if($tournament->creator->golden_account == true)
                    style="color: gold!important;"
                    @else style="color: black!important" @endif href="user/{{$tournament->creator->uid}}"> Created by
                    {{$tournament->creator->name}}</a></p>
            <img class="tournament-image img-thumbnail" src="{{ asset($tournament->image) }}">

            <div class="TournamentDescription">
                {!! $tournament->body !!}
            </div>
            <p class="tournament-date">Created at: <b>{{$tournament->created_at}}</b></p>
        </div>



    </div>
</div>

<style>
    body {}

    .tournament {
        background-color: rgba(255, 255, 255, 0.644);
        border: white solid 2px;
    }

    .tournament-title {
        font-family: 'Lexend Peta', sans-serif;
        text-align: center;
    }

    .tournament-image {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 80%;

    }

    .tournament-author {
        padding-left: 10%;

    }

    .tournament-author {
        color: black !important;
        font-weight: bold;

    }

    .tournament-author:hover {
        text-decoration: underline;
    }

    .tournament-date {
        text-align: left;
        padding-left: 5%;
    }

    .TournamentDescription {
        background-color: rgba(250, 235, 215, 0.281);
        margin-left: 50px;
        margin-right: 50px;
        margin-top: 50px;
        color: black;
        font-family: 'Acme', sans-serif;

    }
</style>



@endsection