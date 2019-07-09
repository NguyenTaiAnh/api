<?php

namespace App\Http\Controllers;

use Config;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;


use Symfony\Component\HttpKernel\Exception\HttpException;
class SignUpController extends Controller
{
    public function signUp(Request $request, JWTAuth $JWTAuth)
    {
        $user = new User($request->all());
        if(!$user->save()) {
            throw new HttpException(500);
        }
//        if(!Config::get('boilerplate.sign_up.release_token')) {
//            return response()->json([
//                'status' => 'ok'
//            ], 201);
//        }
        $token = $JWTAuth->fromUser($user);
        return response()->json([
            'status' => 'ok',
            'token' => $token
        ], 201);
    }
}
