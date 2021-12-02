@extends('layouts.show')

@section('content')


    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12">
            @if ($doc->hasThumbnail())
                <div class="cell small-12 text-center in-view-x gray-image" data-translate="Y" data-from="-600"
                     data-to="0">
                    <img srcset="{{$doc->thumbnail->getSrcSet('1200x600')}}" alt="{{$doc->thumbnail->name}}">
                </div>
            @endif
            <div class="separator-center">&nbsp;</div>
            <div class="separator-center">&nbsp;</div>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 text-center">
            <h1 class="h1">{{ $doc->title }}</h1>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 text-center">
            {!!$doc->description !!}
            <hr>
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
            {!! $doc->content !!}
        </div>
    </div>

    {{--    <div class="grid-x grid-padding-x">--}}

    {{--        @if ($doc->hasCollection())--}}
    {{--            @foreach($doc->library->medias as $media)--}}
    {{--                <div class="cell small-12 text-center in-view-x gray-image"--}}
    {{--                     data-translate="Y"--}}
    {{--                     data-from="{{rand(-600, 600)}}"--}}
    {{--                     data-to="0">--}}
    {{--                    <img srcset="{{$media->getSrcSet('1200x600')}}" alt="{{$media->name}}">--}}
    {{--                </div>--}}
    {{--                <div class="separator-center">&nbsp;</div>--}}
    {{--                <div class="separator-center">&nbsp;</div>--}}
    {{--            @endforeach--}}
    {{--        @endif--}}
    {{--        <div class="separator-center">&nbsp;</div>--}}
    {{--    </div>--}}

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
    <x-meta.doc :data="$doc"/>
@endsection

@section('meta.common')
    <x-meta.common :data="$doc"/>
@endsection

@section('title')
    {{$doc->meta_title}}
@endsection
