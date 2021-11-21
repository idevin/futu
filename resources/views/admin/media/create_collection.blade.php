@extends('admin.layouts.app')

@section('content')
    <h1>@lang('media.create_collection')</h1>

    {!! Form::open(['url' => routeLink('admin.media.store_collection'), 'method' =>'POST',]) !!}


    <div class="form-group">
        {!! Form::label('collection_name', __('media.attributes.name')) !!}
        {!! Form::text('collection_name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}

        @error('name')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <a href="{{routeLink('admin.media.index')}}" class="btn btn-secondary">
        {{__('forms.actions.back')}}
    </a>

    {!! Form::submit(__('forms.actions.save'), ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection
~