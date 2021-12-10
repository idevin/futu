@if(!empty($data->meta_title))
    <meta name="title" content="{{$data->meta_title}}"/>
@endif

@if(!empty($data->meta_description))
    <meta name="description" content="{{$data->meta_description}}"/>
@endif

@if(!empty($data->meta_keywords))
    <meta name="keywords" content="{{$data->meta_keywords}}"/>
@endif

<meta property="og:url" content="{{request()->url()}}"/>

<meta property="og:type" content="website"/>

@if(!empty($data->title))
    <meta property="og:title" content="{{$data->title}}"/>
@endif

<meta property="og:site_name" content="{{ config("app.name", "Laravel") }}"/>

@if(!empty($data->meta_description))
    <meta property="og:description" content="{{$data->meta_description}}"/>
@endif

<meta property="og:locale" content="{{config('app.locale')}}"/>
<meta property="og:locale_alternate" content="{{config('app.default_locale')}}"/>

@if(!empty($data->google_tag))
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', '{{$data->google_tag}}');</script>
@endif

@if($data->google_analytics)
    <script>
        window.ga = window.ga || function () {
            (ga.q = ga.q || []).push(arguments)
        };
        ga.l = +new Date;
        ga('create', '{{$data->google_analytics}}', 'auto');
        ga('send', 'pageview');
    </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>
@endif
