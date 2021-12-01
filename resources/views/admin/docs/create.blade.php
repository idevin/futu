@extends('admin.layouts.app')

@section('content')
    <h1>@lang('docs.create')</h1>
<hr>
    {!! Form::open(['url' => routeLink('admin.docs.store'), 'method' =>'POST']) !!}
    @include('admin/docs/_form')

    <a href="{{routeLink('admin.docs.index')}}" class="btn btn-secondary">
        {{ __('forms.actions.back')}}
    </a>

    {!! Form::submit(__('forms.actions.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
