@foreach($posts as $post)
    @include('posts/_show_search', ['post' => $post])
@endforeach

