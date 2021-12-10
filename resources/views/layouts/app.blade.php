<!doctype html>
<html lang="{{ app()->getLocale() }}">

@section('meta.common')
    <x-meta.common :data="$settings"/>
@endsection

@section('title')
    @if($settings->title)
        {{$settings->title}}
    @endif
@endsection

@include('shared.header')

<body>

@if(!empty($settings->google_tag))
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NP93NPG"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
@endif

@include('shared.preloader')

<div id="app">

    @include('shared.home_nav')

    @yield('content')

    <div class="separator-center">&nbsp;</div>
    <div class="separator-center">&nbsp;</div>

    @include('shared.footer')
</div>

</body>
</html>
