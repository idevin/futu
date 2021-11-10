<div class="card-small">
    @if ($post->hasThumbnail())
        <div class="card-small-image">
            {{$post->thumbnail->img('350x250')}}
            <a href="{{ routeLink('posts.show', ['slug' => $post->slug])}}" class="card-small-image-block-hover stretched-link">
                <div class="card-small-image-block-zoom">
                    <svg fill="#ffffff" height="15px" viewBox="0 0 31 32" width="14px">
                        <path
                            d="M30.438 29.147l-7.622-7.924a12.848 12.848 0 0 0 3.022-8.304C25.838 5.784 20.054 0 12.919 0S0 5.784 0 12.919c0 7.135 5.784 12.919 12.919 12.919h.043c2.761 0 5.318-.876 7.407-2.366l-.039.026 7.678 7.98c.306.321.737.52 1.215.52.453 0 .865-.18 1.167-.472.319-.307.517-.738.517-1.215 0-.453-.178-.864-.469-1.167l.001.001zM12.925 3.358c5.277 0 9.554 4.277 9.554 9.554s-4.277 9.554-9.554 9.554a9.553 9.553 0 0 1-9.554-9.554c.008-5.273 4.281-9.546 9.553-9.554h.001z"
                        ></path>
                    </svg>
                </div>
            </a>
        </div>
    @endif

    <div class="card-small-body">
        <div class="card-small-body-title-area ellipsis">
            <h2 class="card-small-body-title">
                <a href="{{ routeLink('posts.show', ['slug' => $post->slug]) }}">{{$post->title}}</a>
            </h2>
        </div>
        <div class="card-small-body-text-area">
            <p class="card-small-body-text">
                @if(!empty($post->description))
                    {{ strip_tags(Str::limit($post->description, 170)) }}
                @else
                    {!!  strip_tags(Str::limit($post->content, 170)) !!}
                @endif
            </p>
        </div>
        <div style="display: flex; justify-content: space-between">
            <div class="card-small-body-text">
                <small class="text-muted">
                    {{ humanize_date($post->posted_at) }}
                </small>
            </div>

            <div class="text-muted">
                @if($settings->show_comments_count == 1)
                    <i class="fa fa-comments-o" aria-hidden="true"></i>
                    {{ $post->comments_count }}
                @endif
            </div>
        </div>

    </div>
</div>
