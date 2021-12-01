<table class="table table-responsive-md">
    <caption>{{ trans_choice('docs.count', $docs->total()) }}</caption>
    <thead>
    <tr>
        <th>@lang('docs.attributes.title')</th>
        <th>@lang('docs.attributes.thumbnail')</th>
        <th>@lang('docs.attributes.created_at')</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($docs as $doc)
        <tr>
            <td>
                <a href="{{routeLink('admin.docs.edit', $doc->id)}}">
                    {{$doc->setLocale(config('app.default_locale'))->title}}
                </a>
            </td>
            <td>
                @include ('admin/docs/_thumbnail')
            </td>
            <td>{{ humanize_date($doc->created_at, 'd/m/Y H:i:s') }}</td>
            <td style="white-space: nowrap;">
                <a href="{{ routeLink('admin.docs.edit', $doc) }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                &nbsp;
                {!! Form::model($doc, ['method' => 'DELETE', 'url' => routeLink('admin.docs.destroy', $doc), 'class' => 'form-inline', 'data-confirm' => __('forms.docs.delete'), 'data-form-id' => $doc->id]) !!}
                {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm', 'name' => 'submit', 'type' => 'submit']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $docs->links() }}
</div>
