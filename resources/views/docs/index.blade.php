@extends('layouts.show')


@section('content')
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 text-center">
            <h1 class="h1">{{ __('main.docs') }}</h1>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12">
            <div class="separator-center">&nbsp;</div>
            <div class="separator-center">&nbsp;</div>
        </div>
    </div>

    @if(count($docs) > 0)
        <div class="grid-x grid-padding-x align-center-middle">
            @foreach($docs as $doc)
                @include('docs._card', ['doc' => $doc])

        @endforeach
        </div>
    @endif

@endsection

@section('title')
    {{ __('main.docs') }}
@endsection
