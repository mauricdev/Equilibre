<?php

namespace equilibre\Http\Controllers;

use Illuminate\Http\Request;

use equilibre\Http\Requests;

class loginController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {      
            return view('auth/login');
    }
}
