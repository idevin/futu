@if(count($categories) > 0)
    <ul class="footer">
        @foreach($categories as $category)
            <li>
                <a href="{{routeLink('categories.show', $category['slug_path'], true)}}">
                    {{$category['title']}}
                </a>
            </li>
        @endforeach
    </ul>
@endif