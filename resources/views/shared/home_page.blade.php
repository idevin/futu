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
                            <a href="#0">Home</a>
                        </li>
                        <li>
                            <a href="#0">Projects</a>
                        </li>
                        <li>
                            <a href="#0">Express</a>
                        </li>
                        <li>
                            <a href="#0">Contacts</a>
                        </li>
                    </ul>
                </div>
                <div class="top-bar-right">
                    <ul class="menu">
                        <li>
                            <a href="{{routeLink('home')}}">
                                <img src="/images/logo.svg" alt="?" width="100%" height="100%">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="cell small-12 medium-12">
            <div class="separator-center show-for-large show-for-medium show-for-landscape"
                 style="background-color: #57215b; height: 2px;margin-top: 20px;">&nbsp;
            </div>

            <ul class="dropdown menu gray" style="padding-top: 1rem; padding-bottom: 1rem;" data-dropdown-menu>
                <li>
                    <a style="color: black; font-weight: bold;" href="#">All projects</a>
                </li>
                <li>
                    <a href="#">Item 2</a>
                    <ul class="menu">
                        <li><a href="#">Item 1A</a></li>
                    </ul>
                </li>
                <li><a href="#">Item 3</a></li>
                <li><a href="#">Item 4</a></li>
            </ul>
        </div>
    </div>
</div>

<style>
    .dropdown.menu > li.is-dropdown-submenu-parent > a::after {
        border-color: #FFFFFF;
        display: none;
    }

    li.is-submenu-item.is-dropdown-submenu-item:first-child a {
        padding-left: 10px !important;
    }
</style>