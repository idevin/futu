<ul class="menu">
    @foreach($categories as $category)
        <li>
            <a href="{{routeLink('categories.show', ['slug_path' => $category['slug_path']])}}">
                {{$category['title'][session()->get('locale')]}}
            </a>
            @if (count($category['children']) > 0)
                @include('components._nav_categories', ['categories' => $category['children']])
            @endif
        </li>
    @endforeach
</ul>