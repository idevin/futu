<ul class="footer email-links">

    @if($settings->email)
        <li>

            GENERAL INFO:
            <div>
                <a href="mailto:{{$settings->email}}">
                   {{$settings->email}}
                </a>
            </div>
        </li>
    @endif

    <li>
        CONSULTATION:
        <div>
            <a href="mailto:anastasiya@futuconcepts.com">anastasiya@futuconcepts.com</a>
        </div>
        <div>
            <a href="mailto:george@futuconcepts.com">george@futuconcepts.com</a>
        </div>
    </li>
    <li>
        CURRENT ACCOUNTS:
        <div>
            <a href="mailto:michelle@futuconcepts.com">michelle@futuconcepts.com</a>
        </div>
    </li>
    <li>
        CRAZY STUFF AND OFFFERS: <br/>
        <div>
            <a href="mailto:john@futuconcepts.com">john@futuconcepts.com</a>
        </div>
    </li>
</ul>