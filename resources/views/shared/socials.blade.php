<ul>
    @if($settings->instagram)
        <li>
            <a target="_blank" href="{{$settings->instagram}}">
                <img src="/images/menu-instagram.svg" alt="Instagram">
            </a>
        </li>
    @endif
    @if($settings->facebook)
        <li>
            <a target="_blank" href="{{$settings->facebook}}">
                <img src="/images/menu-facebook.svg" alt="Facebook">
            </a>
        </li>
    @endif
    @if($settings->twitter)
        <li>
            <a target="_blank" href="{{$settings->twitter}}">
                <img src="/images/menu-twitter.svg" alt="Twitter">
            </a>
        </li>
    @endif
    @if($settings->linkedin)
        <li>
            <a target="_blank" href="{{$settings->linkedin}}">
                <img src="/images/menu-linkedin.svg" alt="LinkedIn">
            </a>
        </li>
    @endif
    @if($settings->behance)
        <li>
            <a href="{{$settings->behance}}" target="_blank">
                <img src="/images/menu-behance.svg" alt="Behance">
            </a>
        </li>
    @endif
</ul>