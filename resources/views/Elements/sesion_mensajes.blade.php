@if (Session::has('success'))
    <div class="grid-x session_sucess session_msg">
        <div class="small-12">
            <div class="success callout">
                <p>{{ Session::get('success') }}</p>
            </div>
        </div>
    </div>
@endif


@if (Session::has('error') || Session::has('error_message'))
    <div class="grid-x session_error session_msg">
        <div class="small-12">
            <div class="alert callout">
                <p>{{ Session::get('error') }}{{ Session::get('error_message') }}</p>
            </div>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="grid-x session_error session_msg">
        <div class="small-12">
            <div class="alert callout">
                <p>{{ __('general.constants_text.ERROR') }}</p>
            </div>
        </div>
    </div>
@endif
