<?php
$category = routelink('docs');
?>


@if(method_exists($data, 'hasThumbnail') && $data->hasThumbnail())
    <meta property="og:image" content="{{$data->thumbnail->getUrl()}}"/>
    @if(!empty($data->thumbnail->name))
        <meta property="og:image:alt" content="{{$data->thumbnail->name}}"/>
    @endif
@endif

<meta property="article:published_time" content="{{$data->posted_at}}"/>

@if(!empty($data->updated_at))
    <meta property="article:modified_time" content="{{$data->updated_at}}"/>
@endif

<meta property="article:section" content="{{$category}}"/>

@if(!empty($tags))
    <meta property="article:tag" content="{!!$tags!!}"/>
@endif

<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Article",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "{{request()->url()}}"
  },
  "headline": "{{$data->title}}",
  @if(method_exists($data, 'hasThumbnail') && $data->hasThumbnail())
        "image": "{{$data->thumbnail->getUrl()}}",
  @endif
    "datePublished": "{{$data->created_at}}",
  "dateModified": "{{$data->updated_at}}"
}

</script>
