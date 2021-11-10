@extends('layouts.app')

@section('content')
    <div class="grid-x">
        <div class="cell large-12 small-12 medium-12">
            <h1 class="h1">@lang('auth.login')</h1>

            {!! Form::open(['url' => routeLink('login'), 'role' => 'form', 'method' => 'POST']) !!}
            {!! Form::label('email', __('validation.attributes.email'), ['class' => 'control-label']) !!}
            {!! Form::email('email', old('email'), ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'required', 'autofocus']) !!}

            @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror

            {!! Form::label('password', __('validation.attributes.password'), ['class' => 'control-label']) !!}
            {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'required']) !!}

            @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror

            <div class="checkbox">
                <label>
                    {!! Form::checkbox('remember', null, old('remember')) !!} @lang('auth.remember_me')
                </label>
            </div>

            <div class="separator-center">&nbsp;</div>

            {!! Form::submit(__('auth.login'), ['class' => 'primary button large']) !!}

            <a class="clear button large gray-link float-right"
               href="{{routeLink('password.update')}}">{{__('auth.forgotten_password')}}</a>

            {!! Form::close() !!}

            @if (env('GITHUB_ID'))
                <a href="{{ routeLink('auth.provider', ['provider' => 'github']) }}" class="primary button large">
                    @lang('auth.services.github')
                    <i class="fa fa-github" aria-hidden="true"></i>
                </a>
            @endif

            @if (env('TWITTER_ID'))
                <a href="{{ routeLink('auth.provider', ['provider' => 'twitter']) }}"
                   class="button">
                    @lang('auth.services.twitter')
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
            @endif
        </div>
    </div>
    <div class="separator-center">&nbsp;</div>
    <div class="separator-center">&nbsp;</div>
@endsection
