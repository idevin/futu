@if (Session::has('success'))
    <div type="success">
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('errors'))
    <div class="grid-x grid-padding-y grid-padding-x">
        @if ($errors->count() > 1)
            {{ trans_choice('validation.errors', $errors->count()) }}

            @foreach($errors->all() as $error)
                <div class="cell small-12 red text-center">
                    {{ $error }}
                </div>
            @endforeach
        @else
            <div class="cell small-12 red text-center">
                <span class="circle">&#9900;</span> &nbsp; {{ $errors->first() }}
            </div>
        @endif
    </div>
@endif
