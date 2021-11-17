@extends('admin.layouts.app')

@section('content')
    <h1>@lang('media.create')</h1>

    {!! Form::open(['url' => routeLink('admin.media.store'), 'method' =>'POST', 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('image', __('media.attributes.image')) !!}
        {!! Form::file('image', ['accept' => 'image/*', 'class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''), 'required']) !!}

        @error('image')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        {!! Form::label('name', __('media.attributes.name')) !!}
        {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}

        @error('name')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    {{--    {{ link_to_route('admin.media.index', __('forms.actions.back'), [], ['class' => 'btn btn-secondary']) }}--}}

    <a href="{{routeLink('admin.media.index')}}" class="btn btn-secondary">
        {{__('forms.actions.back')}}
    </a>

    {!! Form::submit(__('forms.actions.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
