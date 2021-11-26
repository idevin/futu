@extends('layouts.show')


{{--    <div class="mt-5">--}}
{{--            <div class="section">--}}
{{--                <div class="section-title">--}}
{{--                    <h1>--}}
{{--                        {{$category->title}}--}}
{{--                    </h1>--}}
{{--                </div>--}}

{{--                @include('posts._list')--}}
{{--            </div>--}}
{{--    </div>--}}

@section('content')
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 text-center">
            <h1 class="h1">{{ $category->title }}</h1>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12">
            <div class="separator-center">&nbsp;</div>
            <div class="separator-center">&nbsp;</div>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 text-center">
            {!!$category->content !!}
        </div>
    </div>

    @if(count($posts) > 0)

        @foreach($posts as $postArray)
            @include('posts/_card_category', ['postSlice' => $postArray])
        @endforeach
    @endif

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 text-center">
            {{ $postsPaginated->links() }}
        </div>
    </div>

@endsection

@section('meta.common')
    <x-meta.common :data="$category"/>
@endsection

@section('title')
    {{$category->title}}
@endsection
