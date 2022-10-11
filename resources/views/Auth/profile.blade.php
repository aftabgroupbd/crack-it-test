<h2 class="text-white mt-0 text-center">Profile</h2>
<hr class="divider divider-light" />
<div class="card">
    <div class="card-body">
        <form action="{{route('profile')}}" method="post" id="data_form">
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
                <input type="text" class="form-control" value="{{auth()->user()->name}}" id="name" name="name" placeholder="Enter Your Name" />
                  @error('name')
                      <small class="form-text  text-danger">{{ $message }}</small>
                  @enderror
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*<span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="{{auth()->user()->email}}" />
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
                <button id="submit_btn" type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
    </div>
</div>