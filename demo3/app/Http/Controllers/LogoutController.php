<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.auth', []);
    }

    public function logout(){
        Auth::guard()->logout();
        return response()->json([
            'message'=>'Successfull'
        ]);
    }
}
