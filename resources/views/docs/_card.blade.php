<div class="cell small-6 medium-6 in-view-x"
     data-translate="Y"
     data-from="{{rand(-600, 600)}}"
     data-to="0">

    @if($doc->thumbnail)
        <a href="{{ routeLink('docs.show', $doc) }}" class="grayed">
            <img srcset="{{$doc->thumbnail->getSrcSet('720x480')}}"
                 alt="{{$doc->thumbnail->name}}">
        </a>
    @endif

    <br/> <br/>

    <a style="color: black; font-size: 1.2rem;" href="{{ routeLink('docs.show', $doc) }}" class="grayed">
        <span style="font-weight: bold;"> {{$doc->title}} </span>
    </a>

    @if($doc->description)
        <description>
            <div class="annotation">{!! $doc->description !!}</div>
        </description>
    @endif
</div>