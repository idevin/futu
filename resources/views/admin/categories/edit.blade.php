@extends('admin.layouts.app')

@section('content')

    <div class="page-header d-flex justify-content-between">
        <h1>{{$category->title}}</h1>
        <p>
            @lang('categories.show') :
            <a href="{{routeLink('categories.show', $category->slug_path)}}">
                {{$category->title}}
            </a>
        </p>
    </div>
    <hr>

    @include('admin/categories/_thumbnail')

    {!! Form::model($category, ['url' => routeLink('admin.categories.update', $category), 'method' =>'PUT']) !!}
    @include('admin/categories/_form')

    <div class="pull-left">

        <a href="{{routeLink('admin.categories.index')}}" class="btn btn-secondary">
            {{__('forms.actions.back')}}
        </a>

        {{-- {{ link_to_route('admin.categories.index', __('forms.actions.back'), [], ['class' => 'btn btn-secondary']) }}--}}

        {!! Form::submit(__('forms.actions.update'), ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

    {!! Form::model($category, ['method' => 'DELETE', 'url' => routeLink('admin.categories.destroy', $category), 'class' => 'form-inline pull-right', 'data-confirm' => __('forms.categories.delete')]) !!}
    {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ' . __('categories.delete'), ['class' => 'btn btn-link text-danger', 'name' => 'submit', 'type' => 'submit']) !!}
    {!! Form::close() !!}
@endsection
