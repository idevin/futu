<div class="tags">
    @foreach($tags as $tag)
        @if($tag->slug)
            <a href="{{routeLink('tags.show', ['slug' => $tag->slug])}}" class="label primary"
               style="padding: 10px;">
                {{$tag->name}}
            </a>
        @endif
    @endforeach
</div>
