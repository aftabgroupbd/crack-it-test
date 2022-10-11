@extends('master')
@section('body')
<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-lg-6">
        @if(auth()->user())
          @include('Auth.profile')
        @else
          @include('Auth.login')
        @endif
    </div>
</div>
@endsection
@section('extra_js')
    <script>
        $("#data_form").on('submit', function() {
            let spinner = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...`;
            $("#submit_btn").html(spinner);
            $('#submit_btn').prop('disabled', true);
        });
    </script>
@endsection