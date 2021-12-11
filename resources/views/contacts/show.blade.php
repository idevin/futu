@extends('layouts.show')

@section('content')
    <div class="grid-x grid-padding-x">
        <div class="cell small-12 medium-6 large-6 in-view-x" data-translate="Y"
             data-from="{{rand(-600, 600)}}"
             data-to="0">
            {!! $settings->content !!}
        </div>
        <div class="cell small-12 medium-6 large-6 hide-for-small-only" data-translate="Y"
             data-from="{{rand(-600, 600)}}" data-to="0">
            <img src="/images/logo-contacts.svg" alt="Our Contacts">
        </div>
    </div>

    @if($settings->address)

        <div class="separator-center hide-for-small-only">&nbsp;</div>
        <div class="separator-center hide-for-small-only">&nbsp;</div>
        <div class="separator-center hide-for-small-only">&nbsp;</div>
        <div class="grid-x grid-padding-x">
            <div class="cell small-12 medium-12 large-12 in-view-x" data-translate="Y"
                 data-from="{{rand(-600, 600)}}"
                 data-to="0">

                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="100%" height="500" id="gmap_canvas"
                                src="https://maps.google.com/maps?q={{$settings->address}}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        ></iframe>

                        <style>
                            .mapouter {
                                position: relative;
                                text-align: right;
                                height: 500px;
                                width: 100%;
                            }
                        </style>

                        <style>
                            .gmap_canvas {
                                overflow: hidden;
                                background: none !important;
                                height: 500px;
                                width: 100%;
                            }
                        </style>
                    </div>
                </div>

            </div>
        </div>
    @endif
@endsection

@section('title')
    @if($settings->title)
        {{$settings->title}}
    @endif
@endsection

@section('meta.common')
    <x-meta.common :data="$settings"/>
@endsection