@extends('users.layout', ['tab' => 'profile'])

@section('main_content')
  <div class="card">
    <div class="card-body">
      <h1>@lang('users.profile')</h1>
      <hr class="my-4">

      {!! Form::model($user, ['method' => 'PATCH', 'url' => routeLink('users.update')]) !!}

        <div class="form-group row">
          {!! Form::label('name', __('users.attributes.name'), ['class' => 'col-sm-2 col-form-label']) !!}

          <div class="col-sm-10">
            {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => __('users.placeholder.name'), 'required']) !!}

            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          {!! Form::label('email', __('users.attributes.email'), ['class' => 'col-sm-2 col-form-label']) !!}

          <div class="col-sm-10">
            {!! Form::text('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => __('users.placeholder.email'), 'required']) !!}

            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
            {!! Form::label('first_name', __('users.attributes.first_name'), ['class' => 'col-sm-2 col-form-label']) !!}

            <div class="col-sm-10">
                {!! Form::text('first_name', null, ['class' => 'form-control' . ($errors->has('first_name') ? ' is-invalid' : ''), 'placeholder' => __('users.placeholder.first_name')]) !!}

                @error('first_name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('last_name', __('users.attributes.last_name'), ['class' => 'col-sm-2 col-form-label']) !!}

            <div class="col-sm-10">
                {!! Form::text('last_name', null, ['class' => 'form-control' . ($errors->has('last_name') ? ' is-invalid' : ''), 'placeholder' => __('users.placeholder.last_name')]) !!}

                @error('last_name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group offset-sm-2">
          {!! Form::submit(__('forms.actions.save'), ['class' => 'btn btn-success']) !!}
        </div>

      {!! Form::close() !!}
    </div>
  </div>
@endsection
