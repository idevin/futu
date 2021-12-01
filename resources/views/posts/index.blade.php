@extends('layouts.app')

@section('content')

    <div class="grid-x grid-padding-x align-top">
        <div class="cell small-12 video-container"></div>
    </div>

    <div class="separator-center">&nbsp;</div>

    <div class="grid-x grid-padding-x align-top">
        <div class="cell small-12 medium-4">
            <b>WHO WE ARE</b>
        </div>
        <div class="cell small-12 medium-8">
            <p>As a Design Studio we strongly believe that every concept creation is way beyond beautiful images and
                catchy
                phrases.</p>

            <p>Design is science, where every element is carefully planned based on the ideas it has to represent and
                then
                implemented into a concept where every single piece is strategically placed to
                serve a specific function in making your Brand unique.</p>

            <p>We use an intellectual approach and our Creativity is based on experience and qualifications of our team.
                Our
                way of Concept Development is technological, scientific and almost mathematical.
                Therefore reasoning behind every dot and pixel can be explained.</p>

            <p>
                Nothing is left to chance and nothing is random.<br/>
                Every single image serves a purpose.<br/>
                Every pattern is thoroughly planned.<br/>
                Every color has a meaning.<br/>
                Every word is a statement.<br/>
            </p>

            Our Projects cover <a href="#">Web Design</a>, <a href="#">Graphic Design</a>, <a href="#">Brand
                Development</a>,
            <a href="#">Branding and further support</a>.
        </div>
    </div>

    <div class="separator-center">&nbsp;</div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12" style="padding: .7rem 1rem;">
            <b>ALL PROJECTS</b>
        </div>
        @if(count($categories) > 0)
            <div class="cell small-12 medium-12">
                <ul class="dropdown menu gray flex-dir-row-reverse" data-dropdown-menu>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{routeLink('categories.show', $category['slug_path'])}}">
                                {{$category['title'][app()->getLocale()]}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="separator-center">&nbsp;</div>

    @if(isset($posts) && count($posts) > 0)

        @foreach($posts as $postArray)
            @include('posts/_card', ['postSlice' => $postArray])

            @if($postArray && count($postArray) % 2 == 0 && $loop->last)
                <div class="grid-x grid-padding-x"
                     style="align-items: center;  justify-content: center; height:90px;">
                    @endif

                    @if($postArray && count($postArray) % 2 == 0 && $loop->last)
                        <div class="cell small-6 in-view-x"
                             data-translate="Y"
                             data-from="{{rand(-600, 600)}}"
                             data-to="0"
                             style="text-align: center;">
                            <b><a href="{{routeLink('projects')}}" class="gray-link">More Projects</a></b>
                        </div>
                    @endif
                </div>

                @endforeach

            @endif


            <div class="separator-center">&nbsp;</div>
            <div class="separator-center">&nbsp;</div>
            <a style="color: black; text-decoration: none;" href="{{routeLink('docs.show', ['alias' => 'express'])}}">
                <div class="grid-x grid-padding-x gray-background">
                    <div class="cell medium-7 large-7 hide-for-small-only hide-for-medium-only"
                         style="overflow: hidden; display: flex;">
                        <div class="white-line">&nbsp;</div>
                        <img src="/images/500.png" class="mckinley">
                    </div>
                    <div class="cell medium-12 large-5 text-right" style="padding: 25px; padding-bottom: 10px;">
                        <h1>McKINLEY LOGO EXPRESS</h1>
                        <br>
                        <h3>YOU can start by getting <br> a professional LOGO</h3>
                        <br>
                        <h3 style="font-weight: bold; font-size: 1.5rem;">1 Logo 1 Week 1 McKINLEY</h3>
                        <br>
                        <h3 class="gray">*Small Business and StartUps ONLY</h3>
                    </div>
                </div>
            </a>

            <div class="separator-center">&nbsp;</div>
            <div class="separator-center">&nbsp;</div>

            <div class="grid-x grid-padding-x align-top">
                <div class="cell small-12">
                    <b>OUR CLIENTS</b>
                </div>
            </div>

            <div class="separator-center">&nbsp;</div>

            <div class="grid-x grid-margin-x grid-padding-x align-center img-clients in-view-x" data-from="-300"
                 data-to="0">
                <div class="cell auto">
                    <img src="/images/clients/CheckDeSucre.png"/>
                </div>
                <div class="cell auto">
                    <img src="/images/clients/HustleFest.png"/>
                </div>
                <div class="cell auto">
                    <img src="/images/clients/Kant.png"/>
                </div>
                <div class="cell auto">
                    <img src="/images/clients/Never2serious.png"/>
                </div>
                <div class="cell auto">
                    <img src="/images/clients/Madonna.png"/>
                </div>
            </div>

            <div class="separator-center">&nbsp;</div>

            <div class="grid-x grid-margin-x grid-padding-x align-center img-clients in-view-x" data-from="500"
                 data-to="0">
                <div class="cell auto">
                    <img src="/images/clients/Calipso.png"/>
                </div>
                <div class="cell auto">
                    <img src="/images/clients/UVO.png"/>
                </div>
                <div class="cell auto">
                    <img src="/images/clients/RadicalRuhm.png"/>
                </div>
                <div class="cell auto">
                    <img src="/images/clients/iowa.png"/>
                </div>
                <div class="cell auto">
                    <img src="/images/clients/Pravda.png"/>
                </div>
            </div>

            <div class="separator-center">&nbsp;</div>

            <div class="grid-x grid-margin-x grid-padding-x align-center img-clients in-view-x" data-translate="Y"
                 data-from="-200"
                 data-to="0">
                <div class="cell auto">
                    <img src="/images/clients/Aurora.png"/>
                </div>
                <div class="cell auto">
                    <img src="/images/clients/Superjet.png"/>
                </div>
                <div class="cell auto">
                    <img src="/images/clients/VeganCafe.png"/>
                </div>
                <div class="cell auto">
                    <img src="/images/clients/Academy.png"/>
                </div>
                <div class="cell auto">
                    <img src="/images/clients/igro-market.png"/>
                </div>
            </div>


            {{--    <div class="page-header mt-5">--}}
            {{--        <div class="row">--}}
            {{--            <div class="col-lg-9 mb-5 mb-sm-0 mb-md-0">--}}
            {{--                <div class="section">--}}
            {{--                    <div class="section-title">--}}
            {{--                        <h1>@lang('posts.last_posts')</h1>--}}
            {{--                    </div>--}}
            {{--                    <div class="section-items main-carousel">--}}
            {{--                        @foreach($posts as $post)--}}
            {{--                            <div class="section-item carousel-cell">--}}
            {{--                                @include('posts/_card')--}}
            {{--                            </div>--}}
            {{--                        @endforeach--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="col-lg-3 mb-2">--}}
            {{--                @include ('posts/_search_form')--}}

            {{--                <span class="d-sm-none d-lg-block d-md-block d-xl-block">--}}
            {{--                    @include('posts/_tags')--}}
            {{--                </span>--}}
            {{--            </div>--}}
            {{--        </div>--}}
            {{--    </div>--}}

            {{--    @push('inline-scripts')--}}
            {{--        <script src="{{asset('js/flickity.min.js')}}"></script>--}}
            {{--        <script>--}}
            {{--            const elem = document.querySelector('.main-carousel')--}}
            {{--            const flkty = new Flickity(elem, {--}}
            {{--                cellAlign: 'center',--}}
            {{--                initialIndex: 2,--}}
            {{--                contain: true,--}}
            {{--                wrapAround: true,--}}
            {{--                groupCells: true,--}}
            {{--                autoPlay: 5000,--}}
            {{--                pauseAutoPlayOnHover: true,--}}
            {{--                prevNextButtons: false,--}}
            {{--            })--}}
            {{--        </script>--}}
            {{--    @endpush--}}

            {{--    @if(count($allPosts) > 0)--}}
            {{--        <div class="section">--}}
            {{--            @foreach($allPosts as $post)--}}

            {{--                @if(count($post['posts']) > 0)--}}
            {{--                    <div class="section-title mb-4 mt-3 mt-sm-0">--}}
            {{--                        <h1>{{$post['category']->title}}</h1>--}}
            {{--                    </div>--}}
            {{--                    @include ('posts/_list', ['posts' => $post['posts']])--}}
            {{--                @endif--}}
            {{--            @endforeach--}}
            {{--        </div>--}}
            {{--    @endif--}}



@endsection
