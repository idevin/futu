<h1>@lang('newsletter.email.welcome')</h1>

<p>
    @lang('newsletter.email.description', ['count' => $posts->count()]) :
</p>

<ul>
    @foreach($posts as $post)
        <li>
            <a href="{{routeLink('posts.show', $post)}}">
                {{$post->title}}
            </a>
            {{--
            {{ link_to_route('posts.show', $post->title, $post) }}
            --}}
        </li>
    @endforeach
</ul>

<p>
    @lang('newsletter.email.thanks')
</p>

<p>
    <a href="{{routeLink('newsletter-subscriptions.unsubscribe', ['email' => $email])}}">
        __('newsletter.email.unsubscribe')
    </a>
    {{--
    {{ link_to_route('newsletter-subscriptions.unsubscribe', __('newsletter.email.unsubscribe'), ['email' => $email]) }}
    --}}
</p>
