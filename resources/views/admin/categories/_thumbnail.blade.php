{{--@if ($category->hasThumbnail())--}}
{{--    {{ Html::image($category->thumbnail->getUrl('350x250'), $category->thumbnail->name, ['class' => 'img-thumbnail', 'width' => '350']) }}--}}

{{--    {!! Form::model($category, ['method' => 'DELETE', 'url' => routeLink('admin.categories_thumbnail.destroy', $category), 'data-confirm' => __('forms.categories.delete_thumbnail')]) !!}--}}
{{--        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ' . __('categories.delete_thumbnail'), ['class' => 'btn btn-link text-danger', 'name' => 'submit', 'type' => 'submit']) !!}--}}
{{--    {!! Form::close() !!}--}}
{{--@endif--}}
