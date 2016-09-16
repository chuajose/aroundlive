<?php

use Illuminate\Http\Request;
//use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
 
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

/*oute::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');*/




Route::group(['middleware' => 'cors'], function () {
    Route::post("/login", 'UserController@login');
});

Route::get('/token', array('middleware' => ['cors', 'jwt.auth'], function() {

    if ( ! $user = \JWTAuth::parseToken()->authenticate() ) {
        return response()->json(['User Not Found'], 404);
    }
    $user = \JWTAuth::parseToken()->authenticate();
    $token = \JWTAuth::getToken();
    $newToken = \JWTAuth::refresh($token);
    return response()->json(['email' => $user->email, 'token' => $newToken], 200);
}));


Route::get('/users/{id}', 'UserController@show');

Route::get('/refresh', 'UserController@refreshToken');


Route::group(['middleware' => ['cors']], function(){

    Route::resource('activities', 'ActivityController', ['except' => [
	    'create', 'edit'
	]]);
    Route::post('activities/upload', 'ActivityController@upload');
	
});

