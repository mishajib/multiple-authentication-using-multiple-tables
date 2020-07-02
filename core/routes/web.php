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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::namespace('Auth')->middleware('preventBackHistory')->group(function () {
    Route::get('logout', 'LoginController@logout')->name('logout');
});

Route::group(['middleware' => ['auth:web', 'preventBackHistory']], function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('update-password', 'HomeController@updatePasswordPage')->name('update.password.page');
    Route::put('update-password', 'HomeController@updatePassword')->name('update.password');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin\Auth', 'as' => 'admin.'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login');
    Route::get('logout', 'LoginController@logout')->name('logout');
//    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
//    Route::post('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.email');
//    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
//    Route::get('password/reset', 'ResetPasswordController@reset')->name('password.update');

});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => ['auth:admin', 'adminauth', 'preventBackHistory']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('update-password', 'DashboardController@updatePasswordPage')->name('update.password.page');
    Route::put('update-password', 'DashboardController@updatePassword')->name('update.password');
});
