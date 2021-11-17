@extends('admin.layouts.app')

@section('content')
    <h1>@lang('categories.create')</h1>
<hr>
    {!! Form::open(['url' => routeLink('admin.categories.store'), 'method' =>'POST']) !!}
    @include('admin/categories/_form')

    <a href="{{routeLink('admin.categories.index')}}" class="btn btn-secondary">
        {{ __('forms.actions.back')}}
    </a>

    {!! Form::submit(__('forms.actions.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
