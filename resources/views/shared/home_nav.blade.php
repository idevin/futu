<div id="top"></div>

<div style=" position: fixed; left: -20px; top: 30%; height:
                50vh; width: 15px; background-color: #fcd436; border: 0;
                border-top-right-radius: 20px 20px; border-bottom-right-radius: 20px 20px;
z-index: 14; opacity: 0;" type="button"
     data-toggle="offCanvasLeft1" class="off-c">
    <div style="
    color: #FFFFFF;
    position: absolute;
    top: 42%;
    left: 25%;">
        ||
    </div>
</div>

<div class="off-canvas-wrapper">
    <div class="off-canvas position-left" id="offCanvasLeft1" data-off-canvas>
        <div style="margin-top: 30%;">
            <ul class="vertical menu drilldown"
                data-drilldown
                data-auto-height="true"
                data-animate-height="true"
                data-back-button="<li class=js-drilldown-back><a tabindex=0> << </a></li>">
                <li><a href="#">One</a></li>
                <li>
                    <a href="#">Two</a>
                    <ul class="menu vertical nested">
                        <li><a href="#">Two A</a></li>
                        <li><a href="#">Two B</a></li>
                        <li><a href="#">Two C</a></li>
                        <li><a href="#">Two D</a></li>
                    </ul>
                </li>
                <li><a href="#">Three</a></li>
                <li><a href="#">Four</a></li>
            </ul>
        </div>
        <div style="position: absolute; bottom: 0; width: 100%;">
            <div class="cell auto menu-socials" style="text-align: center;">
                <ul>
                    <li>
                        <a href="#"><img src="/images/menu-instagram.svg"></a>
                    </li>
                    <li>
                        <a href="#"> <img src="/images/menu-facebook.svg"></a>
                    </li>
                    <li>
                        <a href="#"><img src="/images/menu-linkedin.svg"></a>
                    </li>
                    <li>
                        <a href="#"> <img src="/images/menu-behance.svg"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

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
                            <a href="{{routeLink('express')}}">Express</a>
                        </li>
                        <li>
                            <a href="{{routeLink('contacts')}}">Contacts</a>
                        </li>
                    </ul>
                </div>
                <div class="top-bar-right">
                    <ul class="menu">
                        <li>
                            <img src="/images/logo.svg" alt="?" width="100%" height="100%">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="separator-center">&nbsp;</div>