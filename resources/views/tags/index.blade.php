@extends('layouts.show')


@section('content')
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 text-center">
            <h1 class="h1">{{ __('main.tags') }}</h1>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12">
            <div class="separator-center">&nbsp;</div>
        </div>
    </div>

    @include('shared._tags')

@endsection

@section('title')
    {{ __('main.tags') }}
@endsection
