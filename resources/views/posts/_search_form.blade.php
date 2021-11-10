<div class="section mt-sm-2 mb-sm-4">
    {!! Form::open(['url' => routeLink('posts.search'), 'class' => 'd-flex search', 'method' => 'GET']) !!}
    <div class="input-group mr-sm-3 mt-5 mt-sm-2">
        {!! Form::text('q', null, ['class' => 'form-control', 'placeholder' => __('posts.search')]) !!}
    </div>

    <button class="search-icon mt-5 mt-sm-2" style="border: none; background: none;">
        <svg fill="#ffffff" height="15px" viewBox="0 0 31 32" width="14px">
            <path
                d="M30.438 29.147l-7.622-7.924a12.848 12.848 0 0 0 3.022-8.304C25.838 5.784 20.054 0 12.919 0S0 5.784 0 12.919c0 7.135 5.784 12.919 12.919 12.919h.043c2.761 0 5.318-.876 7.407-2.366l-.039.026 7.678 7.98c.306.321.737.52 1.215.52.453 0 .865-.18 1.167-.472.319-.307.517-.738.517-1.215 0-.453-.178-.864-.469-1.167l.001.001zM12.925 3.358c5.277 0 9.554 4.277 9.554 9.554s-4.277 9.554-9.554 9.554a9.553 9.553 0 0 1-9.554-9.554c.008-5.273 4.281-9.546 9.553-9.554h.001z"
            ></path>
        </svg>
    </button>
    {!! Form::close() !!}
</div>
