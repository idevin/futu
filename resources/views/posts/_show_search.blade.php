<div class="row">
    @if ($post->hasThumbnail())
        <div class="col-2 mb-5 col-sm-3">
            <a href="{{ routeLink('posts.show', ['slug' => $post->slug]) }}">
                <img src="{{$post->thumbnail->getUrl('100x100')}}" alt="{{$post->thumbnail->name}}"
                     style="border-radius: 20%">
            </a>

            <div class="w-100"></div>

            <small class="text-muted" style="white-space: nowrap;">
                {{ humanize_date($post->posted_at) }}
            </small>
        </div>
        <div class="col-10 justify-content-left mb-5 col-sm-9">
            <h4>
                <a href="{{ routeLink('posts.show', ['slug' => $post->slug]) }}">{{$post->title}}</a>
            </h4>

            @if(!empty($post->description))
                {{ strip_tags(Str::limit($post->description, 170)) }}
            @else
                {!!  strip_tags(Str::limit($post->content, 170)) !!}
            @endif

            @if(count($post->tags) > 0)
                <div class="mt-3">
                    <span class="fa fa-tags text-secondary"></span>
                    @foreach($post->tags as $tag)
                        @if($tag->slug)
                            <a class="text-secondary small" href="{{routeLink('tags.show', ['slug' => $tag['slug']])}}">
                                {{$tag['name']}}</a><span class="small text-secondary">, </span>
                        @endif
                    @endforeach
                </div>
            @endif

            @if($post->category)
                <div class="mt-2">
                    <a class="text-secondary" href="{{routeLink('categories.show', ['slug_path' => $post->category->slug_path])}}">
                        <span class="fa fa-list-alt"></span> {{$post->category->title}}
                    </a>
                </div>
            @endif

        </div>
    @endif
</div>
