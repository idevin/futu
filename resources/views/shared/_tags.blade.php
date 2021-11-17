<div class="tags pt-2">
    @foreach($tags as $tag)
        @if($tag->slug)
            <a href="{{routeLink('tags.show', ['slug' => $tag->slug])}}" class="badge badge-pill badge-info mb-2" style="padding: 10px;">
                {{$tag->name}}
            </a>
        @endif
    @endforeach
</div>
