@error('title')
<span class="invalid-feedback">{{ $message }}</span>
@enderror

@error('content')
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
    <div class="form-group">
        {!! Form::label('parent_id', __('categories.attributes.parent_id', [], $locale)) !!}
        {!! Form::select("parent_id", $categories ?? [], $category->parent_id ?? null, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
    </div>

    @foreach(array_keys(config('locales')) as $index => $locale)
        <div class="tab-pane fade show @if($locale == config('app.default_locale')) active @endif" id="nav-{{$locale}}"
             role="tabpanel" aria-labelledby="nav-{{$locale}}-tab">

            <div class="form-group">
                {!! Form::label('title', __('categories.attributes.title', [], $locale)) !!}
                {!! Form::text("title[$locale]", isset($category) ? $category->getTranslation('title', $locale) : null, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('content', __('posts.attributes.content', [], $locale)) !!}
                {!! Form::textarea("content[$locale]", isset($category) ? $category->getTranslation('content', $locale) : null, ['class' => 'form-control trumbowyg-form' . ($errors->has('content') ? ' is-invalid' : '')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('slug', __('categories.attributes.slug', [], $locale)) !!}
                {!! Form::text("slug[$locale]", isset($category) ? $category->getTranslation('slug', $locale) : null, ['class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_title', __('categories.attributes.meta_title', [], $locale)) !!}
                {!! Form::text("meta_title[$locale]", isset($category) ? $category->getTranslation('meta_title', $locale) : null, ['class' => 'form-control' . ($errors->has('meta_title') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_description', __('categories.attributes.meta_description', [], $locale)) !!}
                {!! Form::text("meta_description[$locale]", isset($category) ? $category->getTranslation('meta_description', $locale) : null, ['class' => 'form-control' . ($errors->has('meta_description') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_keywords', __('categories.attributes.meta_keywords', [], $locale)) !!}
                {!! Form::text("meta_keywords[$locale]", isset($category) ? $category->getTranslation('meta_keywords', $locale) : null, ['class' => 'form-control' . ($errors->has('meta_keywords') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>
        </div>
    @endforeach
</div>
