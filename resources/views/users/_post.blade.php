<div class="card mb-2">
    @if ($post->hasThumbnail())
        <a href="{{ routeLink('posts.show', $post)}}">
            {{ Html::image($post->thumbnail->getUrl('350x250'), $post->thumbnail->name, ['class' => 'card-img-top']) }}
        </a>
    @endif

    <div class="card-body">
        <h4 v-pre class="card-title">
            <a href="{{ routeLink('posts.show',$post) }}">
                {{$post->title}}
            </a>

        </h4>

        <p class="card-text">
            <small class="text-muted">{{ humanize_date($post->posted_at) }}</small><br>
            <small class="text-muted">
                <i class="fa fa-comments-o" aria-hidden="true"></i> {{ $post->comments_count }}
                <i class="fa fa-heart-o ml-2" aria-hidden="true"></i> {{ $post->likes_count }}
            </small>
        </p>
    </div>
</div>
