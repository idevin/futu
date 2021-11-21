{{--{{dd($mediaCollections->count())}}--}}
<table class="table table-responsive-md">
    <caption>{{ trans_choice('media.count_collections', count($mediaCollections)) }}</caption>
    <thead>
    <tr>
        <th>@lang('media.attributes.id')</th>
        <th>@lang('media.attributes.collection_name')</th>
        <th>@lang('media.attributes.media_count')</th>
        <th>@lang('media.attributes.created_at')</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($mediaCollections as $collection)
        <tr>
            <td>
                {{$collection['id']}}
            </td>
            <td>
                {{$collection['collection_name']}}
            </td>
            <td>
                {{count($collection['medias'])}}
            </td>
            <td>{{ humanize_date(new \Illuminate\Support\Carbon($collection['created_at']), 'd/m/Y H:i:s') }}</td>
            <td>
                &nbsp;
                <a href="{{ routeLink('admin.media.edit_collection',
['collection' => $collection['id']]) }}" title="{{ __('media.edit_collection') }}"
                   class="btn btn-primary btn-sm">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                </a>
                &nbsp;
                {!! Form::model($collection, ['method' => 'DELETE', 'url' => routeLink('admin.media.destroy_collection', $collection['id']), 'class' => 'form-inline', 'data-confirm' => __('media.destroy_collection')]) !!}
                {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm', 'name' => 'submit', 'type' => 'submit', 'title' => __('media.delete')]) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
