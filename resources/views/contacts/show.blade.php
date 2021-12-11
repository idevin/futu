@extends('layouts.show')

@section('content')
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-6 large-6 in-view-x" data-translate="Y"
             data-from="{{rand(-600, 600)}}"
             data-to="0">
            {!! $settings->content !!}
        </div>
        <div class="cell small-12 medium-6 large-6 hide-for-small-only" data-translate="Y" data-from="{{rand(-600, 600)}}" data-to="0">
            <img src="/images/logo-contacts.svg" alt="Our Contacts">
        </div>
    </div>
    <div class="separator-center">&nbsp;</div>

    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-12 large-12 in-view-x" data-translate="Y"
             data-from="{{rand(-600, 600)}}"
             data-to="0">

        </div>
    </div>
@endsection

@section('title')
    @if($settings->title)
        {{$settings->title}}
    @endif
@endsection

@section('meta.common')
    <x-meta.common :data="$settings"/>
@endsection