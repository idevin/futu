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
                            <a href="{{routeLink('projects')}}">Projects</a></li>
                        <li>
                            <a href="{{routeLink('express')}}">Express</a>
                        </li>
                        <li>
                            <a href="{{routeLink('contacts')}}">Contacts</a>
                        </li>
                    </ul>
                </div>
                <div class="cell small-12 large-6 medium-6">
                    <x-footer_categories />
                </div>
                <div class="cell auto">
                    <ul class="footer">
                        <li>
                            <a href="#">Careers</a>
                        </li>
                        <li>
                            <a href="#">Privacy & Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="cell large-6 small-6">
            <div class="grid-x">
                <div class="cell auto small-12 large-6 medium-6">
                    <ul class="footer email-links">
                        <li>
                            GENERAL INFO:
                            <div>
                                <a href="mailto:info@futuconcepts.com">info@futuconcepts.com</a>
                            </div>
                        </li>
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
                </div>
                <div class="cell auto small-12 large-6 medium-6 text-right">
                    FUTU Concepts <br>
                    Dubai Design District - Dubai - United Arab Emirates
                    <br/><br/>
                    <img src="/images/Whatsup.svg" style="width: 8em;">
                </div>
            </div>
        </div>
    </div>

    <div class="separator-center">&nbsp;</div>

    <div class="grid-x align-center-middle">
        <div class="cell auto small-10 large-3 meduim-3 copyright">
            Copyright © 2020 FUTU Concepts
        </div>
        <div class="cell auto small-10 large-7 meduim-7 socials text-center">
            <ul>
                <li>
                    <a href="#"><img src="/images/instagram.svg"></a>
                </li>
                <li>
                    <a href="#"> <img src="/images/facebook.svg"></a>
                </li>
                <li>
                    <a href="#"><img src="/images/linkedin.svg"></a>
                </li>
                <li>
                    <a href="#"> <img src="/images/behance.svg"></a>
                </li>
            </ul>
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
