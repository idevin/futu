<ul class="navbar-nav navbar-sidenav">
    <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="right" title="@lang('dashboard.dashboard')">
        <a class="nav-link {{ request()->route()->named('admin.dashboard') ? 'active' : '' }}" href="{{ routeLink('admin.dashboard') }}">
            <i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;
            <span class="nav-link-text">@lang('dashboard.dashboard')</span>
        </a>
    </li>

    <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="right" title="@lang('dashboard.posts')">
        <a class="nav-link {{ request()->route()->named('admin.posts.*') ? 'active' : '' }}" href="{{ routeLink('admin.posts.index') }}">
            <i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;
            <span class="nav-link-text">@lang('dashboard.posts')</span>
        </a>
    </li>

    <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="right" title="@lang('dashboard.posts')">
        <a class="nav-link {{ request()->route()->named('admin.categories.*') ? 'active' : '' }}" href="{{ routeLink('admin.categories.index') }}">
            <i class="fa fa-folder-open" aria-hidden="true"></i>&nbsp;
            <span class="nav-link-text">@lang('dashboard.categories')</span>
        </a>
    </li>

    <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="right" title="@lang('dashboard.tags')">
        <a class="nav-link {{ request()->route()->named('admin.tags.*') ? 'active' : '' }}" href="{{ routeLink('admin.tags.index') }}">
            <i class="fa fa-tags" aria-hidden="true"></i>&nbsp;
            <span class="nav-link-text">@lang('dashboard.tags')</span>
        </a>
    </li>

    <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="right" title="@lang('dashboard.comments')">
        <a class="nav-link {{ request()->route()->named('admin.comments.*') ? 'active' : '' }}" href="{{ routeLink('admin.comments.index') }}">
            <i class="fa fa-comments" aria-hidden="true"></i>&nbsp;
            <span class="nav-link-text">@lang('dashboard.comments')</span>
        </a>
    </li>

    <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="right" title="@lang('dashboard.users')">
        <a class="nav-link {{ request()->route()->named('admin.users.*') ? 'active' : '' }}" href="{{ routeLink('admin.users.index') }}">
            <i class="fa fa-users" aria-hidden="true"></i>&nbsp;
            <span class="nav-link-text">@lang('dashboard.users')</span>
        </a>
    </li>

    <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="right" title="@lang('dashboard.media')">
        <a class="nav-link {{ request()->route()->named('admin.media.*') ? 'active' : '' }}" href="{{ routeLink('admin.media.index') }}">
            <i class="fa fa-file" aria-hidden="true"></i>&nbsp;
            <span class="nav-link-text">@lang('dashboard.media')</span>
        </a>
    </li>

    <li class="nav-item" role="presentation" data-toggle="tooltip" data-placement="right" title="@lang('dashboard.settings')">
        <a class="nav-link {{ request()->route()->named('admin.settings.*') ? 'active' : '' }}" href="{{ routeLink('admin.settings.index') }}">
            <i class="fa fa-puzzle-piece" aria-hidden="true"></i>&nbsp;
            <span class="nav-link-text">@lang('dashboard.settings')</span>
        </a>
    </li>

</ul>

<ul class="navbar-nav sidenav-toggler">
    <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
        </a>
    </li>
</ul>
