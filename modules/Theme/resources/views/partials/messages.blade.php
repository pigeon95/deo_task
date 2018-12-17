@if (Session::has('success'))

    <div class="alert alert-success" role="alert">
        <strong>@lang('theme::main.success'):</strong> {{ Session::get('success') }}
    </div>

@endif
