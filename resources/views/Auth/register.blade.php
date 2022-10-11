@extends('master')
@section('body')
<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-lg-6">
        <h2 class="text-white mt-0 text-center">Register</h2>
        <hr class="divider divider-light" />
        <div class="card">
            <div class="card-body">
                <form action="{{route('registerSubmit')}}" method="post" id="data_form">
                    @csrf
                    @if(Session::get('error'))
                      <div class="alert alert-success" role="alert">
                        {{Session::get('error')}}
                      </div>
                    @endif
                    @if(Session::get('success'))
                      <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                      </div>
                    @endif
                    <div class="mb-3">
                      <label for="name" class="form-label">Name <span class="text-danger">*<span></label>
                      <input type="text" class="form-control" value="{{old('name')}}" id="name" name="name" placeholder="Enter Your Name" />
                        @error('name')
                            <small class="form-text  text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email <span class="text-danger">*<span></label>
                      <input type="email" class="form-control" value="{{old('email')}}" id="email" name="email" placeholder="Enter Your Email" />
                        @error('email')
                            <small class="form-text  text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password <span class="text-danger">*<span></label>
                      <input type="password" class="form-control" value="{{old('password')}}" name="password" id="password" placeholder="Enter Your Password">
                      @error('password')
                        <small class="form-text  text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="text-end">
                        <button id="submit_btn" type="submit" class="btn btn-primary">Register</button>
                    </div>
                  </form>
            </div>
        </div>
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