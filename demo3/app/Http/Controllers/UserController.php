<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('jwt.auth', []);
    }

    public function user()
    {

        return response()->json(Auth::guard()->user());
    }
}
