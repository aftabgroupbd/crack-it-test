<h2 class="text-white mt-0 text-center">Login</h2>
        <hr class="divider divider-light" />
        <div class="card">
            <div class="card-body">
                <form action="{{route('loginSubmit')}}" method="post" id="data_form">
                  @csrf
                    @if(Session::get('error'))
                      <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                      </div>
                    @endif
                    @if(Session::get('success'))
                      <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                      </div>
                    @endif
                    <div class="mb-3">
                      <label for="email" class="form-label">Email <span class="text-danger">*<span></label>
                      <input type="email" class="form-control" value="{{old('email')}}" id="email" name="email" placeholder="Enter Your Email" />
                      @error('email')
                        <small class="form-text  text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password <span class="text-danger">*<span></label>
                      <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password">
                      @error('password')
                        <small class="form-text  text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="text-end">
                        <button id="submit_btn" type="submit" class="btn btn-primary">Login</button>
                    </div>
                  </form>
            </div>
        </div>