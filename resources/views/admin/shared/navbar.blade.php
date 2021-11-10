<nav class="navbar fixed-top navbar-dark bg-dark navbar-expand-lg">
    <div class="container">
        <!-- Branding Image -->
        <a href="{{routeLink('home')}}" class="navbar-brand">
            {{config('app.name', 'Laravel')}}
        </a>

    <!-- Collapsed Hamburger -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            @include('admin/shared/sidebar')

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a href="{{routeLink('users.show', Auth::user()->name)}}" class="dropdown-item">
                            {{__('users.public_profile')}}
                        </a>

                        <a href="{{routeLink('users.edit')}}" class="dropdown-item">
                            {{__('users.settings')}}
                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="{{  routeLink('logout') }}"
                           class="dropdown-item"
                           onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            @lang('auth.logout')
                        </a>

                        <form id="logout-form" class="d-none" action="{{ routeLink('logout') }}" method="POST">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

