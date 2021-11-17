<ul>
    @foreach($categories as $index => $category)
        <li>
            <table style="margin-bottom: 0;width: 100%; @if($category->depth == 0) margin-top: 20px; @endif" class="table table-sm table-responsive-md">
                <tr>
                    <td>
                        {!!  str_repeat("&nbsp;&nbsp;&nbsp;", $category->depth)!!}
                        <a data-id="{{$category->id}}"
                           href="{{ routeLink('admin.categories.edit', $category) }}"> {{$category->title}} </a>
                    </td>
                    <td style="text-align: right;">
                        <a data-id="{{$category->id}}" href="{{ routeLink('admin.categories.edit', $category) }}"
                           class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        &nbsp;
                        {!! Form::model($category, ['method' => 'DELETE', 'url' => routeLink('admin.categories.destroy', $category), 'class' => 'form-inline', 'data-confirm' => __('admin.categories.delete'), 'data-id'  => $category->id]) !!}
                        {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm', 'name' => 'submit', 'type' => 'submit']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
            </table>
            @if(count($category->children) > 0)
                <?php $categories = $category->children; ?>
                @include ('admin/categories/_list')
            @endif
        </li>
    @endforeach
</ul>
