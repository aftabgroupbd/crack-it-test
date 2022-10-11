<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts_query = Contact::where('user_id',Auth::user()->id);
        if ($request->has('filter') && $request->get('filter') != '') {
            $contacts_query->where("name","like",$request->get("filter")."%");
        }
        if ($request->has('search') && $request->get('search') != '') {
            $contacts_query->where("name","like","%".$request->get("search")."%")
                            ->orWhere("email","like","%".$request->get("search")."%")
                            ->orWhere("phone","like","%".$request->get("search")."%");
        }
        $contacts    = $contacts_query->latest()->paginate(50);

        if($request->ajax()){
            $view = view('Contacts.list',['contacts'=>$contacts]); 
            $html = $view->render();
            return response()->json(array('error' => false,'message' => 'success','data'=>$html)); 
        } 

        return view('Contacts.index',['title'=>'Contact List','contacts'=>$contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'              => 'required|min:4|max:100',
            'email'             => 'required|min:5|max:100|email',
            'phone_number'      => 'required|min:4|max:100',
            'photo'             => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if($validator->passes())
        {
            if(Contact::where('user_id',Auth::user()->id)->where('phone',$request->phone_number)->first())
            {
                return response()->json(array('error' => true,'check' => true, 'message' => ['phone_number' => 'The phone number has already been taken.']));
            }
            $contact = new Contact();
            $contact->user_id       = Auth::user()->id;
            $contact->name          = $request->name;
            $contact->email         = $request->email;
            $contact->phone         = $request->phone_number;
        
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('assets/contacts'), $imageName);

            $contact->photo         = 'assets/contacts/'.$imageName;
            $contact->save();
            return response()->json(array('error' => false,'check' => false, 'message' => 'Successfully Saved.')); 
        }else{
            return response()->json(array('error' => true,'check' => true, 'message' => $validator->errors()->getMessages()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!is_numeric($id))
        {
            return response()->json(array('error' => true,'message' => 'Data not found!'));
        }
        $contact = Contact::where('user_id',Auth::user()->id)->where('id',$id)->first();
        if($contact == false)
        {
            return response()->json(array('error' => true,'message' => 'Data not found!'));
        }
        return response()->json(array('error' => false,'message' => 'success','data'=>$contact));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function ajaxEdit($id)
    {
        if(!is_numeric($id))
        {
            return response()->json(array('error' => true,'message' => 'Data not found!'));
        }
        $contact = Contact::where('user_id',Auth::user()->id)->where('id',$id)->first();
        if($contact == false)
        {
            return response()->json(array('error' => true,'message' => 'Data not found!'));
        }
        $url  = route('contacts.update',$contact->id);
        $view = view('Contacts.ajaxEdit',['contact'=>$contact]);
        $html =  $view->render();
        return response()->json(array('error' => false,'message' => 'success','data'=>$html,'url'=>$url));
    }

    public function bookmark($id)
    {
        if(!is_numeric($id))
        {
            return response()->json(array('error' => true,'message' => 'Data not found!'));
        }
        $contact = Contact::where('user_id',Auth::user()->id)->where('id',$id)->first();
        if($contact == false)
        {
            return response()->json(array('error' => true,'message' => 'Data not found!'));
        }

        $bookmark = new Bookmark();
        $bookmark->user_id      = Auth::user()->id;
        $bookmark->contact_id   = $id;
        $bookmark->save();
        return response()->json(array('error' => false,'message' => 'The contact is bookmarked'));
    }
    public function bookmarkRemove($id)
    {
        if(!is_numeric($id))
        {
            return response()->json(array('error' => true,'message' => 'Data not found!'));
        }
        $bookmark = Bookmark::where('id',$id)->first();
        if($bookmark == false)
        {
            return response()->json(array('error' => true,'message' => 'Data not found!'));
        }

        Bookmark::where('id',$id)->delete();
        return response()->json(array('error' => false,'message' => 'Bookmark is removed!'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name'              => 'required|min:4|max:100',
            'email'             => 'required|min:5|max:100|email',
            'phone_number'      => 'nullable|min:4|max:100',
            'photo'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if($validator->passes())
        {
            if(!is_numeric($id))
            {
                return response()->json(array('error' => true,'message' => 'Data not found!'));
            }
            $contact = Contact::where('user_id',Auth::user()->id)->where('id',$id)->first();
            if($contact == false)
            {
                return response()->json(array('error' => true,'message' => 'Data not found!'));
            }
            if(Contact::where('user_id',Auth::user()->id)->where('phone',$request->phone_number)->first())
            {
                return response()->json(array('error' => true,'check' => true, 'message' => ['phone_number' => 'The phone number has already been taken.']));
            }
            $contact->name          = $request->name;
            $contact->email         = $request->email;
            if($request->phone_number != '')
            {
                $contact->phone         = $request->phone_number;
            }
            if($request->photo != '')
            {
                $image_path = base_path().'/public/'.$contact->photo; 

                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $imageName = time().'.'.$request->photo->extension();
                $request->photo->move(public_path('assets/contacts'), $imageName);
                $contact->photo         = 'assets/contacts/'.$imageName;
            }
            $contact->update();
            return response()->json(array('error' => false,'check' => false, 'message' => 'Successfully Updated.')); 
        }else{
            return response()->json(array('error' => true,'check' => true, 'message' => $validator->errors()->getMessages()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            if(!is_numeric($id)){
                return response()->json(array('error' => true,'check' => false, 'message' => 'Invalid id!'));
            }  
            $contact = Contact::where('user_id',Auth::user()->id)->where('id',$id)->first();
            if($contact != false){
                if($contact->delete())
                {
                    return response()->json(array('error' => false,'check' => false, 'message' => 'Successfully Deleted.'));
                }else{
                    return response()->json(array('error' => true,'check' => false, 'message' => 'Delete failed!'));
                }
            }else{
                return response()->json(array('error' => true,'check' => false, 'message' => 'Data not found!'));
            }
        }catch(\Exception $e)
        {
            return response()->json(array('error' => true,'check' => false, 'message' => 'Something wrong','url'=> route('/error',$e->getCode())));
        }
    }
}
