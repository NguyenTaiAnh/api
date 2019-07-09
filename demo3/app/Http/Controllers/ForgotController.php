<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Api\V1\Requests\ForgotPasswordRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Config;
use Dingo\Api\Http\FormRequest;

class ForgotController extends Controller
{

    //
    public function forgot(Request $request)
    {
        $user = User::where('email', '=', $request->get('email'))->first();
        if(!$user) {
            throw new NotFoundHttpException();
        }
        $broker = $this->getPasswordBroker();
        $sendingResponse = $broker->sendResetLink($request->only('email'));//loxxi

        if($sendingResponse !== Password::RESET_LINK_SENT) {
            throw new HttpException(500);
        }
        return response()->json([
            'status' => 'ok'
        ], 200);
        //die('asd');
    }
    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    private function getPasswordBroker()
    {
        return Password::broker();
    }
}
