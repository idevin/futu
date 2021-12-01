@include('shared/off-canvas')

<div class="separator-center show-for-large show-for-medium show-for-landscape">&nbsp;</div>

<div data-sticky-container>
    <div class="grid-x grid-padding-x align-top top-menu hide-for-small-only" data-sticky
         data-options="marginTop: 0;"
         data-top-anchor="top"
         data-stick-to="top">
        <div class="cell small-12">
            <div data-responsive-toggle="responsive-menu" data-hide-for="medium">
                <button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
                <div class="title-bar-title">Menu</div>
            </div>

            <div class="top-bar" id="responsive-menu">
                <div class="top-bar-left">
                    <ul class="dropdown menu" data-dropdown-menu>
                        <li>
                            <a href="{{routeLink('home')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{routeLink('projects')}}">Projects</a>
                        </li>
                        <li>
                            <a href="{{routeLink('docs.show', ['alias' => 'express'])}}">Express</a>
                        </li>
                        <li>
                            <a href="{{routeLink('contacts')}}">Contacts</a>
                        </li>
                    </ul>
                </div>
                <div class="top-bar-right">
                    <ul class="menu">
                        <li>
                            <a href="{{routeLink('home')}}">
                                <img class="main-logo" src="/images/logo.svg" alt="?" width="100%" height="100%">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="separator-center">&nbsp;</div>