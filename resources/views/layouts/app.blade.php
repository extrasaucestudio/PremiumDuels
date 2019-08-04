<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">


        <div class="uk-box-shadow-medium uk-navbar-container uk-navbar-primary" uk-navbar="mode: click"
            style="z-index: 2;">
            <div class="uk-container uk-container-expand uk-width-1-1">

                <nav class="uk-navbar uk-animation-slide-top">

                    <div class="uk-navbar-left">
                        <!-- Branding Image -->
                        <a class="uk-navbar-item uk-logo" href="{{ url('/') }}">
                            {{ config('app.name', 'Premium Duels') }}
                        </a>
                    </div>

                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav">
                            @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>

                            @else
                            <li>
                                <a href="#">{{ Auth::user()->name }} &nbsp;<span class="uk-badge">{{Auth::user()->elo}}
                                        <img class="rank_img" src="{{Auth::user()->Title->image}}"></span> </a>
                                <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>
                                            <a href="/home">
                                                Profile
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>

                </nav>

            </div>
        </div>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>