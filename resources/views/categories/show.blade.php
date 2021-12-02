@extends('layouts.show')

@section('content')
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 text-center">
            <h1 class="h1">{{ $category->title }}</h1>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12">
            <div class="separator-center">&nbsp;</div>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 text-center">
            {!!$category->content !!}
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12">
            <div class="separator-center">&nbsp;</div>
        </div>
    </div>

    @if(count($posts) > 0)

        @foreach($posts as $postArray)
            @include('posts/_card_category', ['postSlice' => $postArray])
            @if(!$loop->last)
                <div class="separator-center">&nbsp;</div>
                <div class="separator-center">&nbsp;</div>
            @endif
        @endforeach

        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-12 text-center">
                {{ $postsPaginated->links() }}
            </div>
        </div>
    @endif

@endsection

@section('meta.common')
    <x-meta.common :data="$category"/>
@endsection

@section('title')
    {{$category->title}}
@endsection
