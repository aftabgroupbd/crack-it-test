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
                        <button class="btn btn-primary btn-sm" type="button" title="show contact" onClick="showContact({{$contact->id}})"><i class="fa-regular fa-eye"></i></button>
                        @if($contact->bookmark)
                        <button class="btn btn-danger btn-sm" type="button" title="bookmark remove" onClick="bookmarkRemove({{$contact->bookmark->id}})"><i class="fa-solid fa-heart"></i></button>
                        @else
                        <button class="btn btn-success btn-sm" type="button" title="bookmark" onClick="bookmark({{$contact->id}})"><i class="fa-regular fa-heart"></i></button>
                        @endif
                        <button class="btn btn-warning btn-sm" type="button" title="edit contact" onClick="editContact({{$contact->id}})"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button class="btn btn-danger btn-sm" type="button" title="delete contact" onclick="delete_contact({{$contact->id}})"><i class="fa-solid fa-trash"></i></button>
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