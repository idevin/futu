@extends('layouts.app')

@section('content')

    <div class="grid-x">
        <div class="cell large-12 small-12 medium-12 text-center">
            <h1 class="h1">@lang('auth.login')</h1>
        </div>
    </div>

    @include('shared/alerts')

    {!! Form::open(['url' => routeLink('login'), 'role' => 'form', 'method' => 'POST']) !!}
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
        <div class="cell small-12">
            <label>
                @lang('validation.attributes.password')  <sup class="red">*</sup>
                @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                {!! Form::password('password', ['class' => 'required password' . ($errors->has('password') ? ' is-invalid' : ''), 'required']) !!}

            </label>
        </div>
    </div>

    <div class="separator-center">&nbsp;</div>

    <div class="grid-x align-middle">
        <div class="cell small-6">
            {!! Form::checkbox('remember', null, old('remember')) !!} @lang('auth.remember_me')
            <p>
                {!! Form::submit(__('auth.login'), ['class' => 'primary button large']) !!}
            </p>

        </div>
        <div class="cell small-6 text-right">
            <a class="clear button large gray-link"
               style="padding-right: 0;"
               href="{{routeLink('password.update')}}">{{__('auth.forgotten_password')}}</a>
        </div>
    </div>

    {!! Form::close() !!}


@endsection
