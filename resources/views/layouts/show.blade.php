<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    @auth
        <meta name="api-token" content="{{ auth()->user()->api_token }}">
    @endauth

    <meta charset="utf-8" />
{{--    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">--}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <meta name="rating" content="general">

    <link rel="canonical" href="{{request()->url()}}"/>
    <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon"/>

    @yield('meta.common')
    @yield('meta.post')
    @yield('meta.profile')


    <script>
        window.locale = '{{ app()->getLocale() }}';
        window.blog = {!! blogPrefix() !!}
        window.show_comments = {{(int)$settings->show_comments}};
    </script>


    <!-- CSS Files -->
{{--    <link href="{{asset('bootstrap.min.css')}}" rel="stylesheet" />--}}

    <link href="{{ mix('/css/appshow.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body class="landing-page sidebar-collapse">
    <!-- Navbar -->
    @include('shared/nav-new')
    <!-- End Navbar -->
    <div id="app" class="wrapper">
        @include('shared/alerts')
        @yield('content')
        @include('shared/footer')
    </div>



    <!-- Scripts -->
{{--    <script src="{{ mix('/js/appshow.js') }}"></script>--}}

    @stack('inline-scripts')
</body>
</html>
