@extends('layouts.app')

@section('content')




    <div class="grid-x">
        <div class="cell large-12 small-12 medium-12 text-center">
            <h1 class="h1">@lang('auth.reset_password')</h1>
        </div>
    </div>

    @include('shared/alerts')

    {!! Form::open(['url' => routeLink('password.email'), 'role' => 'form', 'method' => 'POST']) !!}
    <div class="grid-x">
        <div class="cell small-12">
            <label>
                {{__('validation.attributes.email')}} <sup class="red">*</sup>
                @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                {!! Form::email('email', old('email'), ['class' => 'required' . ($errors->has('email') ? ' is-invalid' : ''), 'required', 'autofocus']) !!}
            </label>
        </div>
    </div>

    <div class="grid-x align-middle">
        <div class="cell small-12">
                {!! Form::submit(__('auth.send_password_reset_link'), ['class' => 'primary button large']) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection
