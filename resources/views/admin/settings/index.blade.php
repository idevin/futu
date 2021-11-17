@extends('admin.layouts.app')

@section('content')
    <div class="page-header">
        <h1>
            @lang('settings.index')
        </h1>
    </div>

    <hr>

    {!! Form::model($settings, ['url' => routeLink('admin.settings.update', $settings), 'method' =>'PUT' ]) !!}

    <div class="form-group row">
        <label for="show_author" class="col">
            {{__('settings.show_author')}}
        </label>
        <div class="col">
            <input class="form-check-input" type="checkbox" value="1" id="show_author" name="show_author"
                   @if($settings->show_author == 1)checked="checked"@endif>
        </div>
    </div>

    <hr>

    <div class="form-group row">
        <label for="show_date" class="col">
            {{__('settings.show_date')}}
        </label>
        <div class="col">
            <input class="form-check-input" type="checkbox" value="1" id="show_date" name="show_date"
                   @if($settings->show_date == 1)checked="checked"@endif>
        </div>
    </div>

    <hr>

    <div class="form-group row">
        <label for="allow_comments" class="col">
            {{__('settings.allow_comments')}}
        </label>
        <div class="col">
            <input class="form-check-input" type="checkbox" value="1" id="allow_comments" name="allow_comments"
                   @if($settings->allow_comments == 1)checked="checked"@endif>
        </div>
    </div>

    <hr>

    <div class="form-group row">
        <label for="show_comments_count" class="col">
            {{__('settings.show_comments_count')}}
        </label>
        <div class="col">
            <input class="form-check-input" type="checkbox" value="1" id="show_comments_count" name="show_comments_count"
                   @if($settings->show_comments_count == 1)checked="checked"@endif>
        </div>
    </div>

    <hr>

    <div class="form-group row">
        <label for="show_likes_count" class="col">
            {{__('settings.show_likes_count')}}
        </label>
        <div class="col">
            <input class="form-check-input" type="checkbox" value="1" id="show_likes_count" name="show_likes_count"
                   @if($settings->show_likes_count == 1)checked="checked"@endif>
        </div>
    </div>
    <hr>
    {!! Form::submit(__('forms.actions.save'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
@endsection
