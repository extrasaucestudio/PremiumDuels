@extends('layouts.app')

@section('content')

<head>
    <link href="https://fonts.googleapis.com/css?family=Lexend+Peta&display=swap" rel="stylesheet">
</head>

<div class="uk-section">
    <div class="uk-container uk-container-small ">


        @foreach ($tournaments as $tournament)
        <div class="tournament">
            <br>
            <h1 class="tournament-title "><a class="uk-link-reset" href="tournament/{{$tournament->id}}">
                    {{$tournament->title}}</a></h1>
            <p class="tournament-author"><a class="uk-link-reset" @if($tournament->creator->golden_account == true)
                    style="color: gold!important;"
                    @else style="color: black!important" @endif href="user/{{$tournament->creator->uid}}"> Created by
                    {{$tournament->creator->name}}</a></p>
            <a class="uk-link-reset" href="tournament/{{$tournament->id}}">
                <img class="tournament-image img-thumbnail" src="{{ asset($tournament->image) }}">
            </a>
            <p class="tournament-date">Created at: <b>{{$tournament->created_at}}</b></p>
        </div> <br>
        @endforeach



    </div>
</div>

<style>
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
</style>



@endsection