@extends('layouts.app')

@section('content')
<div class="uk-section">
    <div class="uk-container uk-container-center">

        <div class="uk-width-1-2@m uk-align-center">

            <div class="uk-padding uk-box-shadow-large loginForm">

                <h2>Login</h2>

                <form class="uk-form-stacked" role="form" method="POST" action="{{ route('login') }}">

                    {{ csrf_field() }}

                    <div>
                        <label class="uk-form-label">ID</label>
                        <input id="uid" type="text" class="uk-input{{ $errors->has('uid') ? ' uk-form-danger' : '' }}"
                            name="uid" value="{{ old('uid') }}" required autofocus>

                        @if ($errors->has('uid'))
                        <div class="uk-alert-danger" uk-alert>
                            {{ $errors->first('uid') }}
                        </div>
                        @endif
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label">Password</label>
                        <input id="password" type="password"
                            class="uk-input{{ $errors->has('password') ? ' uk-form-danger' : '' }}" name="password"
                            value="{{ old('password') }}" required>

                        @if ($errors->has('password'))
                        <div class="uk-alert-danger" uk-alert>
                            {{ $errors->first('password') }}
                        </div>
                        @endif
                    </div>

                    <div class="uk-margin">
                        <label><input class="uk-checkbox" type="checkbox" name="remember"
                                {{ old('remember') ? ' checked' : '' }}> Remember me</label>
                    </div>

                    <div class="uk-margin">
                        <button class="uk-button uk-button-primary" type="submit" name="button">Login</button>
                        <a class="uk-float-right" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

<style>
    .loginForm {
        background-color: white;
    }
</style>

@endsection