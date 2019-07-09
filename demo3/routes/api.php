<?php

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;
$api = app(Router::class);
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//$api->version('v1',function ($api){
//    $api->get('login','App\\Http\\Controllers\\MyController@login');
//});

$api->version('v1',function ($api){
    $api->group(['prefix'=>'users'],function (Router $api){
        $api->post('login','App\\Http\\Controllers\\LoginController@login');
        $api->post('logout','App\\Http\\Controllers\\LogoutController@logout');
        $api->post('signup','App\\Http\\Controllers\\SignupController@signup');
        $api->post('user','App\\Http\\Controllers\\UserController@user');

        //nooooo
//        $api->post('forgot','App\\Http\\Controllers\\ForgotController@forgot');
//        $api->post('reset','App\\Http\\Controllers\\ResetController@resetPass');
    });
//    $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
//        $api->get('protected', function() {
//            return response()->json([
//                'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
//            ]);
//        });
//        $api->get('refresh', [
//            'middleware' => 'jwt.refresh',
//            function() {
//                return response()->json([
//                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
//                ]);
//            }
//        ]);
//    });
});
$api->version('v1',function ($api){
    $api->get('ab',function (){
       echo 'aksjdfja';
    });
});
