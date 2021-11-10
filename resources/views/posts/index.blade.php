@extends('layouts.app')

@section('content')
    <div class="page-header mt-5">
        <div class="row">
            <div class="col-lg-9 mb-5 mb-sm-0 mb-md-0">
                <div class="section">
                    <div class="section-title">
                        <h1>@lang('posts.last_posts')</h1>
                    </div>
                    <div class="section-items main-carousel">
                        @foreach($posts as $post)
                            <div class="section-item carousel-cell">
                                @include('posts/_card')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-2">
                @include ('posts/_search_form')

                <span class="d-sm-none d-lg-block d-md-block d-xl-block">
                    @include('posts/_tags')
                </span>
            </div>
        </div>
    </div>

    @push('inline-scripts')
        <script src="{{asset('js/flickity.min.js')}}"></script>
        <script>
            const elem = document.querySelector('.main-carousel')
            const flkty = new Flickity(elem, {
                cellAlign: 'center',
                initialIndex: 2,
                contain: true,
                wrapAround: true,
                groupCells: true,
                autoPlay: 5000,
                pauseAutoPlayOnHover: true,
                prevNextButtons: false,
            })
        </script>
    @endpush

    @if(count($allPosts) > 0)
        <div class="section">
            @foreach($allPosts as $post)

                @if(count($post['posts']) > 0)
                    <div class="section-title mb-4 mt-3 mt-sm-0">
                        <h1>{{$post['category']->title}}</h1>
                    </div>
                    @include ('posts/_list', ['posts' => $post['posts']])
                @endif
            @endforeach
        </div>
    @endif

@endsection
