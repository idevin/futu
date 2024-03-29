<footer>

    <div class="separator-center">&nbsp;</div>
    <div class="separator-center">&nbsp;</div>

    <div class="grid-x align-center">
        <div class="cell large-6 small-6">
            <div class="grid-x grid-margin-x">
                <div class="cell auto small-12 large-6 medium-6">
                    <ul class="footer bold">
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
                <div class="cell small-12 large-6 medium-6">
                    <x-footer_categories/>
                </div>
                <div class="cell auto">
                    <ul class="footer">
                        <li>
                            <a href="{{routeLink('tags')}}">Tags</a>
                        </li>
                        <li>
                            <a href="{{routeLink('docs')}}">Documents</a>
                        </li>
                        <li>
                            <a href="{{routeLink('docs.show', ['alias' => 'careers'])}}">Careers</a>
                        </li>
                        <li>
                            <a href="{{routeLink('docs.show', ['alias' => 'privacy-and-policy'])}}">Privacy & Policy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="cell large-6 small-6">
            <div class="grid-x">
                <div class="cell auto small-12 large-6 medium-6">
                    @include('shared.footer-email-links')
                </div>
                <div class="cell auto small-12 large-6 medium-6 text-right">
                    @if($settings->title)
                        {{$settings->title}}
                        <br>
                    @endif
                    @if($settings->address)
                        {{$settings->address}}
                        <br/>
                    @endif
                    @if($settings->phone)
                        <br/>
                        <a target="_blank" href="{{$settings->phone}}">
                            <img src="/images/Whatsup.svg" style="width: 8em;">
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="separator-center">&nbsp;</div>

    <div class="grid-x align-center-middle">
        <div class="cell auto small-10 large-3 meduim-3 copyright">
            Copyright © 2020

            @if($settings->title)
                {{$settings->title}}
            @endif

        </div>
        <div class="cell auto small-10 large-7 meduim-7 socials text-center">
            @include('shared.socials')
        </div>
        <div class="cell auto text-right">
            <div class="dot-footer">
                <svg aria-hidden="true" focusable="false" role="img"
                     xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 448 512"
                     class="arrow-up">
                    <path fill="currentColor"
                          d="M4.465 263.536l7.07 7.071c4.686 4.686 12.284 4.686 16.971 0L207 92.113V468c0 6.627 5.373 12 12 12h10c6.627 0 12-5.373 12-12V92.113l178.494 178.493c4.686 4.686 12.284 4.686 16.971 0l7.07-7.071c4.686-4.686 4.686-12.284 0-16.97l-211.05-211.05c-4.686-4.686-12.284-4.686-16.971 0L4.465 246.566c-4.687 4.686-4.687 12.284 0 16.97z"
                          class=""></path>
                </svg>
            </div>
        </div>
    </div>

    <script src="{{ mix("/js/app.js") }}"></script>

    @stack('inline-scripts')
</footer>