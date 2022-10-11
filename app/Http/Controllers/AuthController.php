<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register()
    {
        return view('Auth.register',['title' => 'Register']);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'password'              => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');
        
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,])) {
            return redirect('/')->with(['success'=>'Successfully logged in.']);
        }
        return redirect("/")->with(['error'=>'Email or Password is wrong!']);
    }
    public function registerSubmit(Request $request)
    {
        $request->validate([
            'name'                  => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|string|min:8',
        ]);

        $user = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);
        if($user->save()){
            Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
            return redirect('/')->with(['success'=>'Successfully registered.']);
        }
        return redirect("/")->with(['error'=>'Something Wrong!']);
    }
    public function profile(Request $request)
    {
        $request->validate([
            'name'                  => 'required',
            'email'                 => 'nullable|email|unique:users,email',
            'password'              => 'nullable|string|min:8',
        ]);

        $user = Auth::user();
        $user->name         = $request->name;
        if($request->email != '')
        {
            $user->email        = $request->email;
        }
        if($request->password != '')
        {
            $user->password     = Hash::make($request->password);
        }
        if($user->update()){
            return redirect('/')->with(['success'=>'Successfully updated.']);
        }
        return redirect("/")->with(['error'=>'Something Wrong!']);
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
