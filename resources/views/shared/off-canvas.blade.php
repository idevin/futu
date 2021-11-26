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
                @include('shared.socials')
            </div>
        </div>
    </div>
</div>