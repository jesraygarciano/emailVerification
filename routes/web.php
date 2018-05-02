<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['web', 'auth', 'isEmailVerified']], function () {
    Route::get('register/verify', 'App\Http\Controllers\Auth\RegisterController@verify')->name('verifyEmailLink');
    Route::get('register/verify/resend', 'App\Http\Controllers\Auth\RegisterController@showResendVerificationEmailForm')->name('showResendVerificationEmailForm');
    Route::post('register/verify/resend', 'App\Http\Controllers\Auth\RegisterController@resendVerificationEmail')->name('resendVerificationEmail');
});