<form action={{route('contacts.store')}} method="post" id="create_form" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="create-contact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create New Contact</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <small class="text-danger">*</small></label>
                        <input type="text" autocomplete="off" class="form-control" name="name" id="name" placeholder="Enter o name">
                        <span class="text-danger error_name"></span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                        <input type="text" autocomplete="off" class="form-control" name="email" id="email" placeholder="Enter o email">
                        <span class="text-danger error_email"></span>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number <small class="text-danger">*</small></label>
                        <input type="text" autocomplete="off" class="form-control" name="phone_number" id="phone_number" placeholder="Enter o phone number">
                        <span class="text-danger error_phone_number"></span>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo <small class="text-danger">*</small></label>
                        <input type="file" class="form-control" accept="image/*" name="photo" id="photo" />
                        <div id="preview_html">
                            <img id="preview" width="100" src="#" alt="your image" />
                        </div>
                        <span class="text-danger error_photo"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="submit_btn" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>