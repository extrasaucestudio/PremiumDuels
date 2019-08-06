@extends('layouts.app')
@section('content')

<head>

    <link href="https://fonts.googleapis.com/css?family=Bree+Serif&display=swap" rel="stylesheet">
</head>

<div class="uk-section">

    <div class="uk-container uk-container-small user_settings">

        @if (\Session::has('error'))
        <div class="uk-alert-danger" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{!! \Session::get('error') !!}</p>

        </div>
        @endif
        @if (\Session::has('success'))
        <div class="uk-alert-success" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>{!! \Session::get('success') !!}</p>
        </div>
        @endif


        <h1 style="text-align: center; font-family: 'Saira Stencil One', cursive; ">Settings</h1>
        <form action="/user/settings" method="POST" class="uk-position-center">
            <fieldset class="uk-fieldset ">
                {{ csrf_field() }}
                <div class="uk-margin">
                    <label> New Password </label>
                    <input class="uk-input" type="password" name="password"
                        placeholder="new password, min 5 characters">
                </div>

                <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                    <label><input name="hidePass" class="uk-checkbox" type="checkbox" @if($user->hidePass == 1) checked
                        @endif> Hide password message.
                    </label>

                </div>

                <input type="submit" value="Submit" class="uk-button uk-button-primary">

            </fieldset>
        </form>


    </div>
</div>




@endsection


<style>
    .user_settings {
        background-color: white;
        height: 80%;
    }
</style>