@extends('admin.layouts.app')

@section('content')
    {!! Form::model($settings, ['url' => routeLink('admin.settings.update', $settings), 'method' =>'PUT' ]) !!}

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a style="font-weight: bold;" class="nav-link active" id="nav-settings-tab"
               data-toggle="tab" href="#nav-settings" role="tab"
               aria-controls="settings">Settings
            </a>

            <a style="font-weight: bold;" class="nav-link" id="nav-info-tab"
               data-toggle="tab" href="#nav-info" role="tab"
               aria-controls="info">Info
            </a>

            <a style="font-weight: bold;" class="nav-link" id="nav-seo-tab"
               data-toggle="tab" href="#nav-seo" role="tab"
               aria-controls="seo">Seo
            </a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-settings"
             role="tabpanel" aria-labelledby="nav-settings-tab">
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
                    <input class="form-check-input" type="checkbox" value="1" id="show_comments_count"
                           name="show_comments_count"
                           @if($settings->show_comments_count == 1)checked="checked"@endif>
                </div>
            </div>

            <hr>

            <div class="form-group row">
                <label for="show_likes_count" class="col">
                    {{__('settings.show_likes_count')}}
                </label>
                <div class="col">
                    <input class="form-check-input" type="checkbox" value="1" id="show_likes_count"
                           name="show_likes_count"
                           @if($settings->show_likes_count == 1)checked="checked"@endif>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-info"
             role="tabpanel" aria-labelledby="nav-info-tab">

            <div class="form-group">
                {!! Form::label('title', __('settings.title')) !!}
                {!! Form::text("title", $settings->title, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('phone', __('settings.phone')) !!}
                {!! Form::text("phone", $settings->phone, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', __('settings.email')) !!}
                {!! Form::text("email", $settings->email, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('address', __('settings.address')) !!}
                {!! Form::text("address", $settings->address, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('content', __('settings.content')) !!}
                {!! Form::textarea("content", $settings->content, ['class' => 'form-control trumbowyg-form']) !!}
            </div>


        </div>
        <div class="tab-pane fade" id="nav-seo"
             role="tabpanel" aria-labelledby="nav-seo-tab">

            <div class="form-group">
                {!! Form::label('meta_title', __('settings.meta_title')) !!}
                {!! Form::text("meta_title", $settings->meta_title, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_description', __('settings.meta_description')) !!}
                {!! Form::text("meta_description", $settings->meta_description, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_keywords', __('settings.meta_keywords')) !!}
                {!! Form::text("meta_keywords", $settings->meta_keywords, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('google_tag', __('settings.google_tag')) !!}
                {!! Form::text("google_tag", $settings->google_tag, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('google_analytics', __('settings.google_analytics')) !!}
                {!! Form::text("google_analytics", $settings->google_analytics, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <hr>

    {!! Form::submit(__('forms.actions.save'), ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

    {{--    <div class="page-header">--}}
    {{--        <h1>--}}
    {{--            @lang('settings.index')--}}
    {{--        </h1>--}}
    {{--    </div>--}}

    {{--    <hr>--}}


    {{--    <div class="form-group row">--}}
    {{--        <label for="show_author" class="col">--}}
    {{--            {{__('settings.show_author')}}--}}
    {{--        </label>--}}
    {{--        <div class="col">--}}
    {{--            <input class="form-check-input" type="checkbox" value="1" id="show_author" name="show_author"--}}
    {{--                   @if($settings->show_author == 1)checked="checked"@endif>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <hr>--}}

    {{--    <div class="form-group row">--}}
    {{--        <label for="show_date" class="col">--}}
    {{--            {{__('settings.show_date')}}--}}
    {{--        </label>--}}
    {{--        <div class="col">--}}
    {{--            <input class="form-check-input" type="checkbox" value="1" id="show_date" name="show_date"--}}
    {{--                   @if($settings->show_date == 1)checked="checked"@endif>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <hr>--}}

    {{--    <div class="form-group row">--}}
    {{--        <label for="allow_comments" class="col">--}}
    {{--            {{__('settings.allow_comments')}}--}}
    {{--        </label>--}}
    {{--        <div class="col">--}}
    {{--            <input class="form-check-input" type="checkbox" value="1" id="allow_comments" name="allow_comments"--}}
    {{--                   @if($settings->allow_comments == 1)checked="checked"@endif>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <hr>--}}

    {{--    <div class="form-group row">--}}
    {{--        <label for="show_comments_count" class="col">--}}
    {{--            {{__('settings.show_comments_count')}}--}}
    {{--        </label>--}}
    {{--        <div class="col">--}}
    {{--            <input class="form-check-input" type="checkbox" value="1" id="show_comments_count" name="show_comments_count"--}}
    {{--                   @if($settings->show_comments_count == 1)checked="checked"@endif>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <hr>--}}

    {{--    <div class="form-group row">--}}
    {{--        <label for="show_likes_count" class="col">--}}
    {{--            {{__('settings.show_likes_count')}}--}}
    {{--        </label>--}}
    {{--        <div class="col">--}}
    {{--            <input class="form-check-input" type="checkbox" value="1" id="show_likes_count" name="show_likes_count"--}}
    {{--                   @if($settings->show_likes_count == 1)checked="checked"@endif>--}}
    {{--        </div>--}}
    {{--    </div>--}}

@endsection
