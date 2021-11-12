<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;

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

Route::get('/auth/{provider}', 'App\Http\Controllers\SocialAuthController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'App\Http\Controllers\SocialAuthController@handleProviderCallback');


Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/signup', 'App\Http\Controllers\UserController@create');
Route::get('/info/{id}', 'App\Http\Controllers\UserController@usss');
Route::get('/activation/{token}', 'App\Http\Controllers\UserController@activateUser')->name('user.activate');
Route::post('/resend-activation-mail','App\Http\Controllers\UserController@resendActivationMail');


Route::post('/request-reset-password','App\Http\Controllers\UserController@ResetPassword');
Route::get('/routeresetpassword/{token}', function($token) {
    return view('resetPassword')->with(['token'=>$token,'url'=>env('URL').'api/resetpassword']);
});
Route::post('/resetpassword','App\Http\Controllers\UserController@resetPasswordForUser');


Route::get('/posts','App\Http\Controllers\PostController@show');
Route::get('/posts/{id}','App\Http\Controllers\PostController@get');
Route::post('/search/{id}','App\Http\Controllers\PostController@searchPost');
Route::get('/posts/{id}/allComment','App\Http\Controllers\CommentController@allPostComment');



Route::put('/user','App\Http\Controllers\UserController@update');
Route::get('/user/{id}/posts','App\Http\Controllers\PostController@getAnotherUserPosts');
Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/post/{id}/follow','App\Http\Controllers\FollowController@addFollowPost');
    Route::get('/follow/posts','App\Http\Controllers\FollowController@allFollowPost');

    Route::get('/user/{id}/follow','App\Http\Controllers\FollowController@addFollowingUser');
    Route::get('/follow/users','App\Http\Controllers\FollowController@allFollowingUser');

    Route::post('/posts/{id}/addComment','App\Http\Controllers\CommentController@addComment');
    Route::get('/user/posts','App\Http\Controllers\PostController@getAllUserPosts');
    Route::resource('/user', UserController::class);
    Route::post('/uploadAvatar','App\Http\Controllers\UserController@uploadAvatar');
    Route::post('/uploadPost','App\Http\Controllers\PostController@create');
    Route::put('/posts/{id}','App\Http\Controllers\PostController@edit');

});


