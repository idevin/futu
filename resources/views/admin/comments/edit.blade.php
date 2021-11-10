@extends('admin.layouts.app')

@section('content')

    <div class="page-header d-flex justify-content-between">
        <h1>{{$comment->post->title}}</h1>
        <p>
            @lang('comments.show') :
            <a href="{{routeLink('posts.show', $comment->post->slug)}}">
                {{$comment->post->title}}
            </a>
        </p>
    </div>
    <hr>
    @include('admin/comments/_form')
@endsection

