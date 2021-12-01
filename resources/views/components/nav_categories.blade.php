@if(count($categories) > 0)
    <ul class="dropdown menu gray" style="padding-top: 1rem; padding-bottom: 1rem;" data-dropdown-menu>
        @foreach($categories as $category)
            <li>
                <a href="{{routeLink('categories.show', ['slug_path' => $category['slug_path']])}}">
                    {{$category['title']}}
                </a>
                @if (count($category['children']) > 0)
                    @include('components._nav_categories', ['categories' => $category['children']])
                @endif
            </li>
        @endforeach
    </ul>
@endif
