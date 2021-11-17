<nav class="navbar navbar-dark bg-dark fixed-top navbar-expand-md">
    <div class="container">
        <!-- Branding Image -->
        {{--    {{ link_to_route('home', config('app.name', 'Laravel'), [], ['class' => 'navbar-brand']) }}--}}

        <a href="{{routeLink('home')}}" class="navbar-brand">
            {{config('app.name', 'Laravel')}}
        </a>

        <!-- Collapsed Hamburger -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            @admin
            <ul class="navbar-nav">
                <li class="nav-item">
                    {{--                    {{ link_to_route('admin.dashboard', __('dashboard.dashboard'), [], ['class' => 'nav-link']) }}--}}

                    <a href="{{routeLink('admin.dashboard')}}" class="nav-link">
                        {{__('dashboard.dashboard')}}
                    </a>
                </li>
            </ul>
            @endadmin

            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{routeLink('login')}}"> {{__('auth.login')}}</a>


                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{routeLink('register')}}"> {{__('auth.register')}}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a v-pre href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                            <a href="{{routeLink('users.show', Auth::user()->name)}}" class="dropdown-item">
                                {{__('users.public_profile')}}
                            </a>

                            <a href="{{routeLink('users.edit', Auth::user())}}" class="dropdown-item">
                                {{__('users.settings')}}
                            </a>

                            {{--  {{ link_to_route('users.edit', __('users.settings'), [], ['class' => 'dropdown-item']) }}--}}

                            <div class="dropdown-divider"></div>

                            <a href="{{ url('/logout') }}"
                               class="dropdown-item"
                               onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                @lang('auth.logout')
                            </a>

                            <form id="logout-form" class="d-none" action="{{ url('/logout') }}" method="POST">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

