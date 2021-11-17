<meta property="og:type" content="profile"/>
@if(!empty($data->first_name))
    <meta property="profile:first_name" content="{{$data->first_name}}"/>
@endif
@if(!empty($data->last_name))
<meta property="profile:last_name" content="{{$data->last_name}}"/>
@endif
<meta property="profile:username" content="{{$data->name}}"/>

@if(!empty($data->gender))
<meta property="profile:gender" content="{{$data->gender}}"/>
@endif

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "email": "{{$data->email}}",
  "image": "img.webp",
  "name": "{{$data->name}}",
  "telephone": "(000) 000-0000",
  "url": "{{routeLink('users.show', $data->name, true)}}"
}
</script>
