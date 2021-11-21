@extends('layouts.show')

{{--@section('content')--}}
{{--    <div class="page-header mt-5">--}}
{{--        <div class="section">--}}
{{--            <div class="page-header page-header-small">--}}
{{--                <div class="content-center">--}}
{{--                    <div class="container">--}}
{{--                        <h1 class="title">{{ $post->title }}</h1>--}}
{{--                        <div class="text-center">--}}

{{--                            <div class="card-small text-left">--}}
{{--                                <div class="section">--}}
{{--                                    <div class="container post-content">--}}
{{--                                        <p>{!! $post->content !!}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}

{{--                            <div class="section row">--}}
{{--                                @if($settings->show_date == 1)--}}
{{--                                    <div class="text-left col text-secondary">--}}
{{--                                            <span--}}
{{--                                                class="fa fa-calendar-times-o"></span> {{ humanize_date($post->posted_at) }}--}}
{{--                                    </div>--}}
{{--                                @endif--}}

{{--                                @if($settings->show_likes_count == 1)--}}
{{--                                    <div class="col pull-left">--}}

{{--                                        <like--}}
{{--                                            :likes-count="{{ $post->likes_count }}"--}}
{{--                                            :liked="{{ json_encode($post->isLiked()) }}"--}}
{{--                                            :item-id="{{ $post->id }}"--}}
{{--                                            item-type="posts"--}}
{{--                                            :logged-in="{{ json_encode(Auth::check()) }}"--}}
{{--                                        />--}}
{{--                                    </div>--}}
{{--                                @endif--}}

{{--                                @if($settings->show_author == 1)--}}
{{--                                    <div class="text-right col pull-right ">--}}
{{--                                        <a href="{{ routeLink('users.show', ['user' => $post->author->name]) }}"--}}
{{--                                           class="text-secondary"><span--}}
{{--                                                class="fa fa-user-circle-o"></span> {{$post->author->fullname}}</a>--}}
{{--                                    </div>--}}
{{--                                @endif--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    @if($settings->allow_comments == 1)--}}
{{--        @include ('comments/_list')--}}
{{--    @endif--}}
{{--@endsection--}}



@section('content')


    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12">
            @if ($post->hasThumbnail())
                <div class="parallax"
                     style="background-image: url({{$post->thumbnail->getUrl()}}); border-radius: 10px;"></div>
            @endif
            <div class="separator-center">&nbsp;</div>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 text-center">
            <h1 class="h1">{{ $post->title }}</h1>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 text-center">
            {!!$post->description !!}
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12">
            <div class="separator-center">&nbsp;</div>
            <div class="separator-center">&nbsp;</div>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 text-justify">
            {!! $post->content !!}
        </div>
    </div>

    <div class="grid-x grid-padding-x">

        @if ($post->hasCollection())
            @foreach($post->library->medias as $media)
                <div class="cell small-12 text-center in-view-x" data-translate="X" data-from="{{rand(-50, -500)}}" data-to="0">
                    <img srcset="{{$media->getSrcSet('1200x600')}}" alt="{{$media->name}}">
                </div>
                <div class="separator-center">&nbsp;</div>
                <div class="separator-center">&nbsp;</div>
            @endforeach
        @endif
        <div class="separator-center">&nbsp;</div>
    </div>

    @if(count($tags) > 0)
        <div class="separator-center">&nbsp;</div>
        <div class="separator-center">&nbsp;</div>
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-12 text-center">
                @include('shared/_tags')
            </div>
        </div>
    @endif

@endsection

@section('meta.post')
    <x-meta.post :data="$post"/>
@endsection

@section('meta.common')
    <x-meta.common :data="$post"/>
@endsection

@section('meta.profile')
    <x-meta.profile :data="$post->author"/>
@endsection

@section('title')
    {{$post->meta_title}}
@endsection
