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
