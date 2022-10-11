<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::where('user_id',Auth::user()->id)->onlyTrashed()->paginate(2);
        return view('trashs.index',['title'=>'Trash List','contacts'=>$contacts]);
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
        //
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
        $contact = Contact::where('user_id',Auth::user()->id)->where('id',$id)->onlyTrashed()->first();
        if($contact == false)
        {
            return response()->json(array('error' => true,'message' => 'Data not found!'));
        }
        return response()->json(array('error' => false,'message' => 'success','data'=>$contact));
    }

    public function restore($id)
    {
        if(!is_numeric($id))
        {
            return response()->json(array('error' => true,'message' => 'Data not found!'));
        }
        $contact = Contact::where('user_id',Auth::user()->id)->where('id',$id)->onlyTrashed()->first();
        if($contact == false)
        {
            return response()->json(array('error' => true,'message' => 'Data not found!'));
        }
        Contact::onlyTrashed()->where('id', $id)->restore();
        return response()->json(array('error' => false,'message' => 'Successfully restored.'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            $contact = Contact::where('user_id',Auth::user()->id)->where('id',$id)->onlyTrashed()->first();
            if($contact != false){
                if($contact->forceDelete())
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
