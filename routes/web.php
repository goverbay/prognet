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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::namespace('Admin')->prefix('admin')->as('admin.')->group(function() {
//     Auth::routes(['register' => false]);
//  });

Route::get('/login/admin', 'Admin\Auth\LoginController@showLoginForm');
Route::post('/login/admin', 'Admin\Auth\LoginController@adminLogin');

Route::get('/admin/home', 'Admin\AdminController@index')->middleware('admin');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegister')->middleware('admin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::get('/admin/edit-profile','Admin\AdminController@editProfile');
