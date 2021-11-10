<div style="position: relative;">
    <a href="{{routeLink('categories.show', ['slug_path' => $child['slug_path']])}}">
        {{$child['title'][session()->get('locale')]}}
    </a>
    @if (count($children) > 0)
        <div
            class="mainMenuDropDown title hoverLinkAnimate not-uppercase"
            style="position: absolute; transform: translateX(100%); top: 0; right: -1px"
        >

            @foreach ($children as $child)
                @include('shared.categories', ['child' => $child, 'children' => $child['children']])
            @endforeach
        </div>
    @endif
</div>
