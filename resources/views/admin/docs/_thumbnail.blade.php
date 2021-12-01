@if ($doc->hasThumbnail())
    {{ Html::image($doc->thumbnail->getUrl('100x100'), $doc?->thumbnail->name, ['class' => 'img-thumbnail', 'width' => '100']) }}

    {!! Form::model($doc, ['method' => 'DELETE', 'url' => routeLink('admin.docs_thumbnail.destroy', $doc), 'data-confirm' => __('forms.docs.delete_thumbnail')]) !!}
        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ' . __('posts.delete_thumbnail'), ['class' => 'btn btn-link text-danger', 'name' => 'submit', 'type' => 'submit']) !!}
    {!! Form::close() !!}
@endif
