@extends('master')
@section('body')
<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-lg-9">
        <h2 class="text-white mt-0 text-center">Trash List</h2>
        <hr class="divider divider-light" />
        <div class="card">
            <div class="card-header text-end">
                <a class="btn btn-primary btn-sm" href="{{route('contacts.index')}}">Contact List</a>
            </div>
            <div class="card-body">
                <div>
                    @include('trashs.show')
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $contact)
                                <tr>
                                    <td style="vertical-align: middle;">
                                        <img style="width: 70px;height: 65px;border-radius: 50px;background: #F7F7F7;border: 1px solid #ccc;padding: 2px;" src="{{asset('/')}}{{$contact->photo}}" alt="{{$contact->name}}">
                                    </td>
                                    <td style="vertical-align: middle;">{{$contact->name}}</td>
                                    <td style="vertical-align: middle;">{{$contact->phone}}</td>
                                    <td style="vertical-align: middle;">
                                        <button class="btn btn-primary btn-sm" type="button" onClick="showContact({{$contact->id}})" title="show contact"><i class="fa-regular fa-eye"></i></button>
                                        <button class="btn btn-warning btn-sm" type="button" onClick="restoreContact({{$contact->id}})" title="restore contact"><i class="fa-solid fa-rotate-right"></i></button>
                                        <button class="btn btn-danger btn-sm" title="permanent delete" type="button" onclick="delete_contact({{$contact->id}})"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-danger text-center">Data Not Found!</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                    {{ $contacts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@section('extra_js')
<script>
        showContact = (id) =>{
            let url = "{{url('trashs')}}";
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
        restoreContact = (id) =>{
            var url = "{{url('trashs/restore')}}";
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
        delete_contact = (id) =>{
            var url = "{{url('trashs')}}";
                swal({
                    title: "Are you sure you want to permanently delete?",
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