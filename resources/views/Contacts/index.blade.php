@extends('master')
@section('body')
<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-lg-9">
        <h2 class="text-white mt-0 text-center">Contact</h2>
        <hr class="divider divider-light" />
        <div class="card">
            <div class="card-header text-end">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#create-contact">Add New Contact</button>
                <a class="btn btn-danger btn-sm" href="{{route('trashs.index')}}">Trash</a>
            </div>
            <div class="card-body">
                <div>
                    @include('Contacts.form')
                    @include('Contacts.show')
                    @include('Contacts.edit')
                </div>
                <div id="contact_data">
                    @include('Contacts.list')
                </div>
            </div>
        </div>
    </div>
    @include('Contacts.create')
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@section('extra_js')
<script>
    bookmarkRemove = (id) =>{
        var url = "{{url('contacts/bookmark/remove')}}";
        swal({
            title: "Are you sure you want to remove bookmark?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "get",
                    url: url+'/'+id,
                    dataType: "json",
                    cache: false,
                    error: function(xhr, status, error) {
                        swal({
                            title:'Error '+error,
                                text: xhr.responseJSON.message,
                                icon: "error",
                            });
                    },
                    success:
                        function (data) {
                            if (data.error == true) {
                                swal({
                                        text: data.message,
                                        icon: "error",
                                    });
                            }else{
                                swal({
                                    text: data.message,
                                    icon: "success",
                                });
                                location.reload();
                            }
                        }
                });

            } else {
                swal("Not removed!",{
                    icon: "warning",
                });
            }
        });
    }
    bookmark = (id) =>{
        var url = "{{url('contacts/bookmark')}}";
        swal({
            title: "Are you sure you want to delete?",
            text: "you will not be able to recover this request info!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "get",
                    url: url+'/'+id,
                    dataType: "json",
                    cache: false,
                    error: function(xhr, status, error) {
                        swal({
                            title:'Error '+error,
                                text: xhr.responseJSON.message,
                                icon: "error",
                            });
                    },
                    success:
                        function (data) {
                            if (data.error == true) {
                                swal({
                                        text: data.message,
                                        icon: "error",
                                    });
                            }else{
                                swal({
                                    text: data.message,
                                    icon: "success",
                                });
                                location.reload();
                            }
                        }
                });

            } else {
                swal("Not Restored!",{
                    icon: "warning",
                });
            }
        });
    }
    editContact = (id) =>{
        let url = "{{url('contacts/ajax/edit')}}";
            url = url+'/'+id;
        $.ajax({
            method: "get",
            url: url,
            dataType: 'JSON',
            error: function(xhr, status, error) {
                swal({
                    title:'Error '+error,
                        text: xhr.responseJSON.message,
                        icon: "error",
                    });
            },
            success: function(data)
            {
                if (data.error == true) {
                    swal({
                            title: 'Error',
                            text: data.message,
                            icon: "error",
                        });
                }else{
                    $('#edit_form').attr('action',data.url);
                    $('#edit_form_content').html(data.data);
                    $('#editContact').modal('show');
                }
            }
        });
    }
    showContact = (id) =>{
        let url = "{{url('contacts')}}";
            url = url+'/'+id;
        $.ajax({
            method: "get",
            url: url,
            dataType: 'JSON',
            error: function(xhr, status, error) {
                swal({
                    title:'Error '+error,
                        text: xhr.responseJSON.message,
                        icon: "error",
                    });
            },
            success: function(data)
            {
                if (data.error == true) {
                    swal({
                            title: 'Error',
                            text: data.message,
                            icon: "error",
                        });
                }else{
                    let table_content = `<table class="table">
                                            <tbody>
                                            <tr>
                                                <td>Name:</td>
                                                <td>${data.data.name}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone:</td>
                                                <td>${data.data.phone}</td>
                                            </tr>
                                            <tr>
                                                <td>Email:</td>
                                                <td>${data.data.email}</td>
                                            </tr>
                                            <tr>
                                                <td>Photo:</td>
                                                <td>
                                                    <img style="width: 150px;" src="{{asset('/')}}${data.data.photo}" />
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>`;
                    $('#contact_details').html(table_content);
                    $('#showContact').modal('show');
                }
            }
        });
        
    }
    $(document).on("click", ".pagination a", function(e) {
        e.preventDefault();
        let url = $(this).attr("href");
        window.history.pushState({}, null, url);
        get_contact_data(url);
    });
    $("#search").keyup(function(){
        console.log(43243);
        let url = "{{url()->full()}}";
        get_contact_data(url);
    });
    $(document).on('change', '#filter', function(){
        let url = "{{url()->full()}}";
        
        get_contact_data(url);
    });
    get_contact_data = (url) =>{
        let form = $('#searchform');
        $.ajax({
            method: "get",
            url: url,
            headers: {"X-CSRF-TOKEN": "{{csrf_token()}}"},
            data: form.serialize(),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            error: function(xhr, status, error) {
                swal({
                    title:'Error '+error,
                        text: xhr.responseJSON.message,
                        icon: "error",
                    });
            },
            success: function(data)
            {
                if (data.error == true) {
                    swal({
                            title: 'Error',
                            text: data.message,
                            icon: "error",
                        });
                }else{
                    $('#contact_data').html(data.data);
                }
            }
        });
    }
    $("#preview_html").hide();
    $("body").delegate("#create_form #photo", "change", function(){
        const [file] = $(this).files
        if (file) {
            $('#create_form #preview').src = URL.createObjectURL(file)
            $("#create_form #preview_html").show();
        }
    });
    $("body").delegate("#edit_form #photo", "change", function(){
        var file = URL.createObjectURL(event.target.files[0]);
        if (file) {
            $('#edit_form #preview').attr('src',file);
            $("#edit_form #preview_html").show();
        }
    });
    
    $("#edit_form").on('submit', function(e) {
        e.preventDefault();
        let spinner = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...`;
        $("#edit_form #submit_btn").html(spinner);
        $('#edit_form #submit_btn').prop('disabled', true);
        $("#edit_form span").html('');
        $.ajax({
            method: "POST",
            url: $(this).prop('action'),
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            error: function(xhr, status, error) {
                swal({
                    title:'Error '+error,
                        text: xhr.responseJSON.message,
                        icon: "error",
                    });
                    $('#edit_form #submit_btn').prop('disabled', false);
            },
            success: function(data)
            {
                $('#edit_form #submit_btn').html('<i class="fa fa-fw fa-lg fa-check-circle"></i> Submit');
                $("#edit_form span").html('');
                if (data.error == true) {
                    if(data.check ==  true)
                    {
                        $.each(data.message, function( key, value ) {
                            $(".error_"+key).html(value);
                        });
                    }else{
                        swal({
                            title: 'Error',
                            text: data.message,
                            icon: "error",
                        });
                    }
                }else{
                    swal({
                        title: 'Success',
                        text: data.message,
                        icon: "success",
                    });
                    $('#editContact').modal('hide');
                    location.reload();
                }
                $('#edit_form #submit_btn').prop('disabled', false);
            }
        });
    });
    $("#create_form").on('submit', function(e) {
        e.preventDefault();
        let spinner = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...`;
        $("#create_form #submit_btn").html(spinner);
        $('#create_form #submit_btn').prop('disabled', true);
        $("#create_form span").html('');
        $.ajax({
            method: "POST",
            url: $(this).prop('action'),
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            error: function(xhr, status, error) {
                swal({
                    title:'Error '+error,
                        text: xhr.responseJSON.message,
                        icon: "error",
                    });
                    $('#create_form #submit_btn').prop('disabled', false);
            },
            success: function(data)
            {
                $('#create_form #submit_btn').html('<i class="fa fa-fw fa-lg fa-check-circle"></i> Submit');
                $("#create_form span").html('');
                if (data.error == true) {
                    if(data.check ==  true)
                    {
                        $.each(data.message, function( key, value ) {
                            $(".error_"+key).html(value);
                        });
                    }else{
                        swal({
                            title: 'Error',
                            text: data.message,
                            icon: "error",
                        });
                    }
                }else{
                    swal({
                        title: 'Success',
                        text: data.message,
                        icon: "success",
                    });
                    $('#create-contact').modal('hide');
                    location.reload();
                }
                $('#create_form #submit_btn').prop('disabled', false);
            }
        });
    });
    delete_contact = (id) =>{
            var url = "{{url('contacts')}}";
                swal({
                    title: "Are you sure you want to delete?",
                    text: "you will not be able to recover this request info!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "DELETE",
                            url: url+'/'+id,
                            data: {id:id,"_token":"{{csrf_token()}}"},
                            dataType: "json",
                            cache: false,
                            error: function(xhr, status, error) {
                                swal({
                                    title:'Error '+error,
                                        text: xhr.responseJSON.message,
                                        icon: "error",
                                    });
                            },
                            success:
                                function (data) {
                                    if (data.error == true) {
                                        swal({
                                                text: data.message,
                                                icon: "error",
                                            });
                                    }else{
                                        swal({
                                            text: data.message,
                                            icon: "success",
                                        });
                                        location.reload();
                                    }
                                }
                        });

                    } else {
                        swal("Not deleted!",{
                            icon: "warning",
                        });
                    }
                });
        }
</script>
@endsection