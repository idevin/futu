@extends('admin.layouts.app')

@section('content')
    <h1>@lang('posts.create')</h1>
<hr>
    {!! Form::open(['url' => routeLink('admin.posts.store'), 'method' =>'POST']) !!}
    @include('admin/posts/_form')

    <a href="{{routeLink('admin.posts.index')}}" class="btn btn-secondary">
        {{ __('forms.actions.back')}}
    </a>

    {!! Form::submit(__('forms.actions.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
