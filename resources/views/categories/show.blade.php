@extends('layouts.app')

@section('content')
    <div class="mt-5">
            <div class="section">
                <div class="section-title">
                    <h1>
                        {{$category->title}}
                    </h1>
                </div>

                @include('posts._list')
            </div>
    </div>
@endsection

@section('meta.common')
    <x-meta.common :data="$category"/>
@endsection

@section('title')
    :: {{$category->title}}
@endsection
