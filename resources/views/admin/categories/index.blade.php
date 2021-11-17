@extends('admin.layouts.app')

@section('content')
    <div class="page-header d-flex justify-content-between">
        <h1>@lang('dashboard.categories')</h1>
        <a href="{{ routeLink('admin.categories.create') }}" class="btn btn-primary btn-sm align-self-center">
            <i class="fa fa-plus-square" aria-hidden="true"></i> @lang('forms.actions.add')
        </a>
    </div>

    <div class="tree">
        @include ('admin/categories/_list')
    </div>

@endsection
