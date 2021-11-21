<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @auth
        <meta name="api-token" content="{{ auth()->user()->api_token }}">
    @endauth

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script>
        window.locale = '{{ app()->getLocale() }}';
        window.blog = {!! blogPrefix() !!}
    </script>

    <!-- Styles -->
    <link href="{{ mix('/css/admin.css') }}" rel="stylesheet">
</head>
<body class="bg-dark">
@include('admin/shared/navbar')

<div class="content-wrapper bg-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col">

                @include('admin/shared/alerts')

                <div class="card">
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="messageModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body alert"></div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirm">{{__('forms.actions.yes')}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('forms.actions.no')}}</button>
            </div>
        </div>
    </div>
</div>

<div id="app" style="height: auto;"></div>
<!-- Scripts -->

<script src="{{ mix('/js/admin.js') }}"></script>

@yield('scripts')

</body>
</html>
