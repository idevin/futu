@if(count($tags) > 0)
    <div class="tags">
        @foreach($tags as $tag)
            @if($tag->slug)
                <a href="{{routeLink('tags.show', ['slug' => $tag->slug])}}" class="label primary"
                   style="padding: 10px;
                   @if($tag->count && $tag->count != 1)
                           font-size:{{($tag->count/95)+1}}rem;
                   @endif
                           ">
                    {{$tag->name}}
                </a>
            @endif
        @endforeach
    </div>
@endif
