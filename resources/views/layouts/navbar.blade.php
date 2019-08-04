<div id="app">
    <div class="uk-box-shadow-medium uk-navbar-container uk-navbar-primary" uk-navbar="mode: click">
        <div class="uk-container uk-container-expand uk-width-1-1">

            <nav class="uk-navbar">

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
                            <a href="#">{{ Auth::user()->name }}</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                            Logout
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