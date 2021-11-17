@extends('admin.layouts.app')

@section('content')
    <p>@lang('users.show') :
        <a href="{{routeLink('users.show', $user->name)}}">
            {{$user->fullname}}
        </a>

    @include('admin/users/_form')
@endsection
