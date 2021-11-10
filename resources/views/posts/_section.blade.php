<div class="section">
    <div class="section-title">
        <h2>@lang('posts.latest')</h2>
    </div>
    <div class="section-items main-carousel">
        @foreach($items as $post)
            <div class="section-item carousel-cell">
                @include('posts/_card')
            </div>
        @endforeach
    </div>
</div>
