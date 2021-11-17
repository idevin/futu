@extends('admin.layouts.app')

@section('content')
    <div class="page-header d-flex justify-content-between">
        <h1>{{$post->title}}</h1>
        <p>
            @lang('posts.show') :
            <a href="{{routeLink('posts.show', ['slug' => $post->slug])}}">
                {{$post->title}}
            </a>
        </p>
    </div>

    <hr>

    @include('admin/posts/_thumbnail')

    {!! Form::model($post, ['url' => routeLink('admin.posts.update', $post), 'method' =>'PUT']) !!}
    @include('admin/posts/_form')

    <div class="pull-left">

        <a href="{{routeLink('admin.posts.index')}}" class="btn btn-secondary">
            {{__('forms.actions.back')}}
        </a>

        {{-- {{ link_to_route('admin.posts.index', __('forms.actions.back'), [], ['class' => 'btn btn-secondary']) }}--}}

        {!! Form::submit(__('forms.actions.update'), ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

    {!! Form::model($post, ['method' => 'DELETE', 'url' => routeLink('admin.posts.destroy', $post), 'class' => 'form-inline pull-right', 'data-confirm' => __('forms.posts.delete')]) !!}
    {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ' . __('posts.delete'), ['class' => 'btn btn-link text-danger', 'name' => 'submit', 'type' => 'submit']) !!}
    {!! Form::close() !!}
@endsection
