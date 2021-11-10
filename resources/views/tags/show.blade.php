@extends('layouts.app')

@section('content')
    <div class="page-header mt-5">
        <div class="row">
            <div class="col">
                <div class="section">
                    <div class="section-title">
                        <h1>{{$tag->name}}</h1>
                    </div>
                    <div class="section-items main-carousel">
                        @foreach($posts as $post)
                            <div class="section-item carousel-cell">
                                @include('posts/_card')
                            </div>
                        @endforeach
                    </div>
                    <span>{{$posts->links()}}</span>
                </div>
            </div>
        </div>
    </div>

@endsection
