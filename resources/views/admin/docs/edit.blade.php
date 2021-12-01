@extends('admin.layouts.app')

@section('content')
    <div class="page-header">
        <h1>{{$doc->title}}</h1>
        <p>

            @lang('docs.show') :
            <a target="_blank" href="{{routeLink('docs.show', ['alias' => $doc->alias])}}">
                {{$doc->title}}
            </a>
        </p>
    </div>

    <hr>

    @include('admin/docs/_thumbnail')

    {!! Form::model($doc, ['url' => routeLink('admin.docs.update', $doc), 'method' =>'PUT']) !!}

    @include('admin/docs/_form')

    <div class="pull-left">

        <a href="{{routeLink('admin.docs.index')}}" class="btn btn-secondary">
            {{__('forms.actions.back')}}
        </a>

        {!! Form::submit(__('forms.actions.update'), ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

    {!! Form::model($doc, ['method' => 'DELETE', 'url' => routeLink('admin.docs.destroy', $doc), 'class' => 'form-inline pull-right', 'data-confirm' => __('forms.docs.delete')]) !!}
    {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ' . __('docs.delete'), ['class' => 'btn btn-link text-danger', 'name' => 'submit', 'type' => 'submit']) !!}
    {!! Form::close() !!}
@endsection
