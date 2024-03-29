<head>
    <title>@yield('title')</title>

    @auth
        <meta name="api-token" content="{{ auth()->user()->api_token }}">
    @endauth

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <meta name="rating" content="general">
    <link rel="canonical" href="{{request()->url()}}"/>
    <link rel="icon" href="{{ asset('/images/favicon.png') }}" type="image/x-icon"/>


    @yield('meta.common')
    @yield('meta.post')
    @yield('meta.profile')

    <script>
        window.locale = '{{ app()->getLocale() }}';
        window.blog = {!! blogPrefix() !!}
            window.show_comments = {{(int)$settings->show_comments}};
    </script>

    <link href="{{ mix("css/app.css") }}" rel="stylesheet">

    @stack('css')
</head>