<div class="grid-x grid-padding-x">
    @foreach($postSlice as $post)
        <div class="cell auto in-view-x"
             data-translate="Y"
             data-from="{{rand(-600, 600)}}"
             data-to="0">
            @if($post->thumbnail)
                <a href="{{ routeLink('posts.show', $post) }}" class="grayed">
                    <img srcset="{{$post->thumbnail->getSrcSet('720x480')}}"
                         alt="{{$post->thumbnail->name}}">
                </a>
            @endif

            <br/> <br/>

            <a style="color: black;" href="{{ routeLink('posts.show', $post) }}" class="grayed">
                <span style="font-weight: bold;"> {{$post->title}} </span>
            </a>


            @if($post->description)
                <description>
                    <div class="annotation">{!! $post->description !!}</div>
                </description>
            @endif
            @if(!empty($post->year))
                <div class="annotation">{{$post->year}}</div>
            @endif
        </div>
    @endforeach
</div>

<div class="separator-center">&nbsp;</div>