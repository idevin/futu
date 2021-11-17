@if(count($posts) > 0)
    <div class="card-columns">
        @foreach($posts as $post)
            @include('posts/_show', ['post' => $post])
        @endforeach
    </div>
@else
    @include('posts/_empty')
@endif

