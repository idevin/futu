@extends('layouts.show')

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



    @if ($post->hasCollection())

        @php
            $medias = $post->library->medias->chunk(3);
        @endphp

        @foreach($medias as $mediaArray)
            @php
                $cell = 4;
                if(count($mediaArray) == 1){
    $cell = 12;
    }
                if(count($mediaArray) == 2) {
                    $cell = 6;
                }
            @endphp

            <div class="grid-x grid-padding-x flex-column-reverse">
                @foreach($mediaArray as $media)
                    <div class="cell small-{{$cell}} text-center in-view-x gray-image" data-translate="Y"
                         data-from="{{rand(-600, 600)}}" data-to="0">
                        <img srcset="{{$media->getSrcSet('1200x800')}}" alt="{{$media->name}}">
                    </div>
                @endforeach
            </div>
            @if(!$loop->last)
                <div class="separator-center">&nbsp;</div>
                <div class="separator-center">&nbsp;</div>
            @endif
        @endforeach
    @endif

    @if(count($tags) > 0)
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
