@extends('admin.layouts.app')

@section('content')
    <h1 style="float: left;">@lang('dashboard.media_collections')</h1>

    <div class="d-flex justify-content-end">
        <a href="{{ routeLink('admin.media.create') }}" class="btn btn-primary btn-sm align-self-center">
            <i class="fa fa-plus-square" aria-hidden="true"></i> @lang('forms.actions.add')
        </a>
        <a style="float: right;" href="{{ routeLink('admin.media.create_collection') }}"
           class="btn btn-primary btn-sm align-self-center">
            <i class="fa fa-plus-square" aria-hidden="true"></i> @lang('forms.actions.create_collection')
        </a>
        <a style="float: right;" href="{{ routeLink('admin.media.collections') }}"
           class="btn btn-primary btn-sm align-self-center">
            <i class="fa fa-list" aria-hidden="true"></i> @lang('forms.actions.collections')
        </a>
    </div>

    @include('admin/media/_list_collections')
@endsection
