<table class="table table-responsive-md">
    <caption>{{ trans_choice('posts.count', $posts->total()) }}</caption>
    <thead>
    <tr>
        <th>@lang('posts.attributes.title')</th>
        <th>@lang('posts.attributes.author')</th>
        <th>@lang('posts.attributes.posted_at')</th>
        <th><i class="fa fa-comments" aria-hidden="true"></i></th>
        <th><i class="fa fa-heart" aria-hidden="true"></i></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td>
                <a href="{{routeLink('admin.posts.edit', $post->id)}}">
                    {{$post->setLocale(config('app.default_locale'))->title}}
                </a>
            </td>
            <td>
                <a href="{{routeLink('admin.users.edit', $post->author)}}">
                    {{$post->author->fullname}}
                </a>
            </td>
            <td>{{ humanize_date($post->posted_at, 'd/m/Y H:i:s') }}</td>
            <td><span class="badge badge-pill badge-secondary">{{ $post->comments_count }}</span></td>
            <td><span class="badge badge-pill badge-secondary">{{ $post->likes_count }}</span></td>
            <td style="white-space: nowrap;">
                <a href="{{ routeLink('admin.posts.edit', $post) }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                &nbsp;
                {!! Form::model($post, ['method' => 'DELETE', 'url' => routeLink('admin.posts.destroy', $post), 'class' => 'form-inline', 'data-confirm' => __('forms.posts.delete'), 'data-form-id' => $post->id]) !!}
                {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm', 'name' => 'submit', 'type' => 'submit']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $posts->links() }}
</div>
