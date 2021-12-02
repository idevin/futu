@php
    $created_at = old('created_at') ?? (isset($doc) ? $doc->created_at->format('Y-m-d\TH:i') : null);
@endphp

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
    @foreach(array_keys(config('locales')) as $index => $locale)
        <div class="tab-pane fade show @if($locale == config('app.default_locale')) active @endif" id="nav-{{$locale}}"
             role="tabpanel" aria-labelledby="nav-{{$locale}}-tab">

            <div class="form-group">
                {!! Form::label('title', __('docs.attributes.title', [], $locale)) !!}
                {!! Form::text("title[$locale]", isset($doc) ? $doc->getTranslation('title', $locale) : null, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('alias', __('docs.attributes.alias', [], $locale)) !!}
                {!! Form::text("alias[$locale]", isset($doc) ? $doc->getTranslation('alias', $locale) : null, ['class' => 'form-control' . ($errors->has('alias') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('tags', __('docs.attributes.tags', [], $locale)) !!}
                {!! Form::text("tags[$locale]", !empty($tags[$locale]) ? implode(',', $tags[$locale]) : null, ['data-role' => 'tagsinput','data-locale' => $locale, 'data-taggable-id' => isset($doc) ? $doc->id : null, 'data-taggable-type' => \App\Models\Post::class, 'class' => "form-control tags" . ($errors->has('tags') ? ' is-invalid' : '')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', __('docs.attributes.description', [], $locale)) !!}
                {!! Form::textarea("description[$locale]", isset($doc) ? $doc->getTranslation('description', $locale) : null, ['class' => 'form-control trumbowyg-form' . ($errors->has('description') ? ' is-invalid' : '')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('content', __('docs.attributes.content', [], $locale)) !!}
                {!! Form::textarea("content[$locale]", isset($doc) ? $doc->getTranslation('content', $locale) : null, ['class' => 'form-control trumbowyg-form' . ($errors->has('content') ? ' is-invalid' : '')]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_title', __('docs.attributes.meta_title', [], $locale)) !!}
                {!! Form::text("meta_title[$locale]", isset($doc) ? $doc->getTranslation('meta_title', $locale) : null, ['class' => 'form-control' . ($errors->has('meta_title') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_description', __('docs.attributes.meta_description', [], $locale)) !!}
                {!! Form::text("meta_description[$locale]", isset($doc) ? $doc->getTranslation('meta_description', $locale) : null, ['class' => 'form-control' . ($errors->has('meta_description') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_keywords', __('docs.attributes.meta_keywords', [], $locale)) !!}
                {!! Form::text("meta_keywords[$locale]", isset($doc) ? $doc->getTranslation('meta_keywords', $locale) : null, ['class' => 'form-control' . ($errors->has('meta_keywords') ? ' is-invalid' : ''), $locale == config('app.default_locale') ? 'required' : null]) !!}
            </div>
        </div>
    @endforeach
</div>

<div class="form-group">
    {!! Form::label('thumbnail_id', __('docs.attributes.thumbnail')) !!}
    {!! Form::select('thumbnail_id', $media, null, ['placeholder' => __('docs.placeholder.thumbnail'), 'class' => 'form-control' . ($errors->has('thumbnail_id') ? ' is-invalid' : '')]) !!}

</div>

@section('scripts')
@endsection
