<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        if(Auth::user())
        {
            $title = 'Profile';
        }else{
            $title = 'Login';
        }
        return view('index',['title' =>$title]);
    }
}
