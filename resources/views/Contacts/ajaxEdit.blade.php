<div class="mb-3">
    <label for="name" class="form-label">Name <small class="text-danger">*</small></label>
    <input type="text" autocomplete="off" class="form-control" value="{{$contact->name}}" name="name" id="name" placeholder="Enter o name">
    <span class="text-danger error_name"></span>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
    <input type="text" autocomplete="off" class="form-control" value="{{$contact->email}}" name="email" id="email" placeholder="Enter o email">
    <span class="text-danger error_email"></span>
</div>
<div class="mb-3">
    <label for="phone_number" class="form-label">Phone Number </label>
    <input type="text" autocomplete="off" class="form-control" name="phone_number" id="phone_number" placeholder="{{$contact->phone}}">
    <span class="text-danger error_phone_number"></span>
</div>
<div class="mb-3">
    <label for="photo" class="form-label">Photo </label>
    <input type="file" class="form-control" accept="image/*" name="photo" id="photo" />
    <div id="preview_html">
        <img id="preview" width="100" src="{{asset('/')}}{{$contact->photo}}" alt="your image" />
    </div>
    <span class="text-danger error_photo"></span>
</div>