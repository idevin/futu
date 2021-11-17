<nav class="fixed-top">
    <div class="container" id="header-block">
        <div class="row">

            <div class="col col-lg-auto">
                <a href="{{routeLink('home')}}" class="navMainLink">
                    <img src="{{asset(blogPrefix(false) . '/images/logo/logo.svg')}}"
                         alt="Sunnygeorgia travel company logo"
                         class="navLogo"
                    >
                </a>
            </div>
            <div class="col-auto d-lg-none" id="mobile-menu-toggle">
                <button type="button" class="mobileMainMenu">
                    <span></span>
                </button>
            </div>
            <div class="col text-lg-right d-none d-lg-block">

                <div class="mainMenu">
                    <div class="mainMenuItem noHover">
                        <a href="https://sunnygeorgia.travel/{{session()->get('locale')}}">
                            <span>{{__('main.Travel')}}</span>
                        </a>
                    </div>
                    @if(count($categories) > 0)
                        @foreach($categories as $category)

                            @if(isset($category['title'][session()->get('locale')]))
                                <div class="mainMenuItem">

                                    <a href="{{routeLink('categories.show', ['slug_path' => $category['slug_path']])}}">
                                        <span>{{$category['title'][session()->get('locale')]}}</span></a>

                                    @if(count($category['children']) > 0)
                                        <div class="mainMenuDropDown mainMenuDropDown_left title
                                            hoverLinkAnimate not-uppercase"
                                        >
                                            @foreach($category['children'] as $child)
                                                @include('shared.categories', ['child' => $child, 'children' => $child['children']])
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @endif
                    <div class="mainMenuItem language">
                            <span class="language_img">
                                <img
                                    src="{{ asset(blogPrefix(false) . "/images/lang/" . session()->get('locale') . '.png')}}"
                                    alt="">
                            </span>
                        <div class="mainMenuDropDown hoverLinkAnimate">
                            <ul>
                                @foreach(config('locales') as $prefix => $locale)
                                    @if(app()->getLocale() !== $prefix)
                                        <li>
                                            <a rel="alternate" hreflang="{{$prefix}}"
                                               href="{{routeLink('locale', ['locale' => $prefix])}}"
                                            >
                                                <div class="language_img">
                                                    <img
                                                        src="{{asset(blogPrefix(false) . "/images/lang/{$prefix}.png")}}"
                                                        alt="{{$locale}}">
                                                </div>
                                                {{strtoupper($prefix)}}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="main-mobile-menu d-lg-none" id="mobile-menu">
        @if(count($categories) > 0)
            @foreach($categories as $category)
                @if(isset($category['title'][session()->get('locale')]))
                    <div onclick="mobileOpen(this)" data-id="1" class="main-mobile-menu__item">
                        <div class="main-mobile-menu__item-title">
                            <div class="container">
                                {{$category['title'][session()->get('locale')]}}
                                <div class="main-mobile-menu__arrow">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="angle-down"
                                         role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"
                                         class="svg-inline--fa fa-angle-down fa-w-8 fa-3x">
                                        <path fill="currentColor"
                                              d="M119.5 326.9L3.5 209.1c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0L128 287.3l100.4-102.2c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.7 4.7 12.3 0 17L136.5 327c-4.7 4.6-12.3 4.6-17-.1z"
                                              class=""></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @if(count($category['children']) > 0)
                            <div class="main-mobile-menu__sub {{$loop->depth}}">
                                @foreach($category['children'] as $child)
                                    @include('shared.categories-mobile', [
                                                'child' => $child,
                                                'children' => $child['children'],
                                                'blockNumber' => $loop->parent->iteration
                                             ])
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        @endif
        <div onclick="mobileOpen(this)" class="main-mobile-menu__item">
            <span class="main-mobile-menu__item-title">
                <div class="container">
                    {{trans('main.Language')}}
                    <div class="main-mobile-menu__add-text">
                        {{app()->getLocale()}}
                    </div>
                    <div class="main-mobile-menu__arrow">
                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="angle-down"
                             role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"
                             class="svg-inline--fa fa-angle-down fa-w-8 fa-3x">
                            <path fill="currentColor"
                                  d="M119.5 326.9L3.5 209.1c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0L128 287.3l100.4-102.2c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.7 4.7 12.3 0 17L136.5 327c-4.7 4.6-12.3 4.6-17-.1z"
                                  class=""></path>
                        </svg>
                    </div>
                </div>
            </span>
            <div class="main-mobile-menu__sub">
                @foreach(config('locales') as $prefix => $locale)
                    @if(app()->getLocale() !== $prefix)
                        <div class="main-mobile-menu__sub-item">
                            <a class="main-mobile-menu__sub-item-title"
                               rel="alternate"
                               hreflang="{{ $prefix }}"
                               href="{{ routeLink('locale', ['locale' => $prefix]) }}"
                            >
                                <div class="container">
                                    {{ $locale }}
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>


    </div>
</nav>
@push('inline-scripts')
    <script>
        let mobileMenu = false;
        const items = document.querySelectorAll('.main-mobile-menu__item');
        const menuToggleEl = document.getElementById('mobile-menu-toggle');
        const mobileMenuEl = document.getElementById('mobile-menu');

        function changeClass(event) {
            menuToggleEl.firstChild.classList.toggle('on');
            mobileMenuEl.classList.toggle('show');
        }

        window.onload = function () {
            menuToggleEl.addEventListener('click', changeClass, {capture: true});
        };

        function mobileOpen(el) {
            items.forEach(function (item) {

                if (item.isEqualNode(el)) {
                    item.classList.add('main-mobile-menu__item_visible')
                } else {

                    item.classList.remove('main-mobile-menu__item_visible')
                    item.classList.remove('main-mobile-menu__sub-item_visible')
                }
            });
        }

        function mobileSubOpen(el, blockNumber) {
            const curItem = `.main-mobile-menu__sub-item b-${blockNumber}`;
            document.querySelectorAll(curItem).forEach(function (item) {
                if (item.isEqualNode(el)) {
                    item.classList.add('main-mobile-menu__sub-item_visible');
                } else {
                    item.classList.remove('main-mobile-menu__sub-item_visible');
                }
            });
        }
    </script>
@endpush
