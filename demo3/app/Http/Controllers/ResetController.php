<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Config;
use App\User;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ResetController extends Controller
{
    //
    public function resetPass(Request $request, JWTAuth $JWTAuth)
    {
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->reset($user, $password);
        }
        );
        if($response !== Password::PASSWORD_RESET) {
            throw new HttpException(500);
        }
//        if(!Config::get('boilerplate.reset_password.release_token')) {
//            return response()->json([
//                'status' => 'ok',
//            ]);
//        }
        $user = User::where('email', '=', $request->get('email'))->first();
        return response()->json([
            'status' => 'ok',
            'token' => $JWTAuth->fromUser($user)
        ]);
    }
    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }
    /**
     * Get the password reset credentials from the request.
     *
     * @param  ResetPasswordRequest  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }
    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function reset($user, $password)
    {
        $user->password = $password;
        $user->save();
    }
}
