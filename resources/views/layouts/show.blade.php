<!doctype html>
<html lang="{{ app()->getLocale() }}">
@include('shared/header')
<body>

@include('shared/preloader')

<div id="app">

    @include('shared/home_page')

    @yield('content')

    <div class="separator-center">&nbsp;</div>
    <div class="separator-center">&nbsp;</div>

    @include('shared/footer')
</div>

</body>
</html>
