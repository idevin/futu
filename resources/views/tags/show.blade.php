@extends('layouts.show')

@section('content')

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 text-center">
            <h1 class="h1">{{ $tag->name }}</h1>
        </div>
    </div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12">
            <div class="separator-center">&nbsp;</div>
        </div>
    </div>


    @foreach($tagGroups as $groupName => $groups)
        <div class="grid-x grid-padding-x">
            @include('tags.objects', ['groups' => $groups, '$groupName' => $groupName])
        </div>
    @endforeach

@endsection

@section('title')
    {{ $tag->name }}
@endsection
