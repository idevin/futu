@php
    $posted_at = old('posted_at') ?? (isset($post) ? $post->posted_at->format('Y-m-d\TH:i') : null);
@endphp

@error('title')
<span class="invalid-feedback">{{ $message }}</span>
@enderror

@error('content')
<span class="invalid-feedback">{{ $message }}</span>
@enderror

@error('posted_at')
<span class="invalid-feedback">{{ $message }}</span>
@enderror

@error('author_id')
<span class="invalid-feedback">{{ $message }}</span>
@enderror

@error('thumbnail_id')
<span class="invalid-feedback">{{ $message }}</span>
@enderror

<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        @foreach(array_keys(config('locales')) as $index => $locale)
            <a class="nav-link @if($locale == config('app.default_locale')) active @endif" id="nav-{{$locale}}-tab"
               data-toggle="tab" href="#nav-{{$locale}}" role="tab"
               aria-controls="nav-{{$locale}}"><b>{{$locale}}</b></a>
        @endforeach
    </div>
</nav>

<div class="tab-content" id="nav-tabContent">
    @foreach(array_keys(config('locales')) as $index => $locale)
        <div class="tab-pane fade show @if($locale == config('app.default_locale')) active @endif" id="nav-{{$locale}}"
             role="tabpanel" aria-labelledby="nav-{{$locale}}-tab">

            <div class="form-group">
                {!! Form::label('title', __('posts.attributes.title', [], $locale)) !!}
                {!! Form::text("title[$locale]", isset($post) ? $post->getTranslation('title', $locale) : null, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('slug', __('posts.attributes.slug', [], $locale)) !!}
                {!! Form::text("slug[$locale]", isset($post) ? $post->getTranslation('slug', $locale) : null, ['class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tags', __('posts.attributes.tags', [], $locale)) !!}
                {!! Form::text("tags[$locale]", !empty($tags[$locale]) ? implode(',', $tags[$locale]) : null, ['data-role' => 'tagsinput','data-locale' => $locale, 'data-taggable-id' => isset($post) ? $post->id : null, 'data-taggable-type' => \App\Models\Post::class, 'class' => "form-control tags" . ($errors->has('tags') ? ' is-invalid' : '')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', __('posts.attributes.description', [], $locale)) !!}
                {!! Form::text("description[$locale]", isset($post) ? $post->getTranslation('description', $locale) : null, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('content', __('posts.attributes.content', [], $locale)) !!}
                {!! Form::textarea("content[$locale]", isset($post) ? $post->getTranslation('content', $locale) : null, ['class' => 'form-control trumbowyg-form' . ($errors->has('content') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_title', __('posts.attributes.meta_title', [], $locale)) !!}
                {!! Form::text("meta_title[$locale]", isset($post) ? $post->getTranslation('meta_title', $locale) : null, ['class' => 'form-control' . ($errors->has('meta_title') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_description', __('posts.attributes.meta_description', [], $locale)) !!}
                {!! Form::text("meta_description[$locale]", isset($post) ? $post->getTranslation('meta_description', $locale) : null, ['class' => 'form-control' . ($errors->has('meta_description') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_keywords', __('posts.attributes.meta_keywords', [], $locale)) !!}
                {!! Form::text("meta_keywords[$locale]", isset($post) ? $post->getTranslation('meta_keywords', $locale) : null, ['class' => 'form-control' . ($errors->has('meta_keywords') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>
        </div>
    @endforeach
</div>
<br/>
<hr>
<br/>

<div class="form-row">
    <div class="form-group col-md-12">
        {!! Form::label('category_id', __('posts.attributes.category')) !!}
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control' . ($errors->has('category_id') ? ' is-invalid' : '')]) !!}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('author_id', __('posts.attributes.author')) !!}
        {!! Form::select('author_id', $users, null, ['class' => 'form-control' . ($errors->has('author_id') ? ' is-invalid' : ''), 'required']) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('posted_at', __('posts.attributes.posted_at')) !!}
        <input type="datetime-local" name="posted_at"
               class="form-control {{ ($errors->has('posted_at') ? ' is-invalid' : '') }}" value="{{ $posted_at }}">
    </div>
</div>

<div class="form-group">
    {!! Form::label('thumbnail_id', __('posts.attributes.thumbnail')) !!}
    {!! Form::select('thumbnail_id', $media, null, ['placeholder' => __('posts.placeholder.thumbnail'), 'class' => 'form-control' . ($errors->has('thumbnail_id') ? ' is-invalid' : '')]) !!}

</div>



@section('scripts')
    @if(!empty($tags))
        {{--        <script>--}}
        {{--            $('.tags').autoComplete('set', '{{implode(',', $tags) }}');--}}
        {{--        </script>--}}
    @endif
@endsection
