    <div class="cell small-12 medium-12 text-center">
        <h5>
            {{__('main.' . slugify($groupName))}}
        </h5>
    </div>

        <div class="cell small-12 medium-12">
            <div class="separator-center">&nbsp;</div>
        </div>

@foreach($groups as $group)
        <div class="cell small-6 in-view-x"
             data-translate="Y" data-from="{{rand(-600, 600)}}" data-to="0">
            @if($group->hasThumbnail())
                <a href="{{ routeLink($group::$route, $group) }}" class="grayed">
                    <img srcset="{{$group->thumbnail->getSrcSet('720x480')}}" alt="{{$group->thumbnail->name}}">
                </a>
            @endif

            <br/> <br/>

            <a style="color: black;" href="{{ routeLink($group::$route, $group) }}" class="grayed">
                <span style="font-weight: bold;"> {{$group->title}} </span>
            </a>


            @if($group->description)
                <description>
                    <div class="annotation">{!! $group->description !!}</div>
                </description>
            @endif
                <div class="grid-x grid-padding-x">
                    <div class="cell small-12 medium-12">
                        <div class="separator-center">&nbsp;</div>
                        <div class="separator-center">&nbsp;</div>
                    </div>
                </div>
        </div>
@endforeach