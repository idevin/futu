@extends('users.layout', ['tab' => 'api_token'])

@section('main_content')
    <div class="card">
        <div class="card-body">
            <h1>@lang('users.attributes.api_token')</h1>

            <div class="form-group" id="api-key">{{$user->api_token ?? __('users.empty_api_token')}}</div>
            <hr>
            <div class="d-flex">
                {!! Form::model($user, ['method' => 'PATCH', 'url' => routeLink('users.token.update', $user), 'style' => 'width:100%','class' => 'd-flex']) !!}
                {!! Form::submit(__('forms.actions.generate'), ['class'=> 'btn btn-success', 'data-confirm' => __('forms.tokens.generate')]) !!}
                <a style="margin-left: auto; align-self: center;" href="#" class="copy-to-clipboard" data-copy="api-key">{{__('forms.actions.copy_to_clipboard')}}</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
