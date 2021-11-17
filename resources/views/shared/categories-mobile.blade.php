<div onclick="mobileSubOpen(this, {{$blockNumber}})" class="main-mobile-menu__sub-item {{$loop->depth}}{{$blockNumber}}">
    <a class="main-mobile-menu__sub-item-title"
       href="{{routeLink('categories.show', ['slug_path' => $child['slug_path']])}}"
    >
        <div class="container">
            {{$child['title'][session()->get('locale')]}}
            <div
                class="main-mobile-menu__sub-item-title__arrow">
                <svg aria-hidden="true" focusable="false" data-prefix="fal"
                     data-icon="angle-down"
                     role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512"
                     class="svg-inline--fa fa-angle-down fa-w-8 fa-3x">
                    <path fill="currentColor"
                          d="M119.5 326.9L3.5 209.1c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0L128 287.3l100.4-102.2c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.7 4.7 12.3 0 17L136.5 327c-4.7 4.6-12.3 4.6-17-.1z"
                          class=""></path>
                </svg>
            </div>
        </div>
    </a>
    @if (count($children) > 0)
        <div class="main-mobile-menu__sub-item__sub">
            @foreach ($children as $child)
                @include('shared.categories-mobile', [
                            'child' => $child,
                            'children' => $child['children'],
                            'blockNumber' => 'b-' . $loop->parent->iteration
                          ])
            @endforeach
        </div>
    @endif
</div>
