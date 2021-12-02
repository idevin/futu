@if($postArray && count($postArray) % 2 != 0 && $loop->last)
    <div class="grid-x grid-padding-x" style="align-items: center;  justify-content: center;">
        @else
            <div class="grid-x grid-padding-x">
                @endif

                @foreach($postSlice as $post)
                    <div class="cell small-6 in-view-x" data-translate="Y" data-from="{{rand(-600, 600)}}" data-to="0">

                        @if($post->thumbnail)
                            <a href="{{ routeLink('posts.show', $post) }}" class="grayed">
                                <img srcset="{{$post->thumbnail->getSrcSet('720x480')}}"
                                     alt="{{$post->thumbnail->name}}">
                            </a>
                        @endif

                        <br/> <br/>

                        <a style="color: black;" href="{{ routeLink('posts.show', $post) }}" class="grayed">
                            <span style="font-weight: bold;"> {{$post->title}} </span>
                        </a>


                        @if($post->description)
                            <description>
                                <div class="annotation">{!! $post->description !!}</div>
                            </description>
                        @endif
                        @if(!empty($post->year))
                            <div class="annotation">{{$post->year}}</div>
                        @endif
                    </div>
                @endforeach

                @if($postArray && count($postArray) % 2 != 0 && $loop->last)
                    <div class="cell small-6 in-view-x" data-from="-400" data-to="0" style="text-align: center;">
                        <b><a href="{{routeLink('projects')}}" class="gray-link">More Projects</a></b>
                    </div>
                @endif

            </div>

            <div class="separator-center">&nbsp;</div>