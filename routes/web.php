<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'admin','namespace'=>'Backend','middleware'=>['auth:admin']],function(){
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'RolesController');
    Route::resource('users', 'UserController');
    Route::resource('admins', 'AdminController');
});
Route::group(['prefix'=>'admin','namespace'=>'Backend'],function(){
    //login route
    Route::get('/login','Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit','Auth\LoginController@login')->name('admin.login.submit');
    //logout route
    Route::post('/logout/submit','Auth\LoginController@logout')->name('admin.logout.submit');
    // forgot password
    Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset','Auth\ResetPasswordController@reset')->name('password.update');


});

