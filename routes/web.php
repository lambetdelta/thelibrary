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

Route::get('/', 'Auth\LoginController@showLoginForm')
    ->name('viewLogin');

Route::get('entrar', 'Auth\LoginController@showLoginForm')
    ->name('viewLoginMain');

Route::post('entrar', 'Auth\LoginController@login')
    ->name('login');

Route::post('salir', 'Auth\LoginController@logout')
    ->name('logout');

Route::get('contraseña/recuperar', 'Auth\ForgotPasswordController@showLinkRequestForm')
	->name('password.request');

Route::post('contraseña/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
	->name('password.email');

Route::get('contraseña/recuperar/{token}', 'Auth\ResetPasswordController@showResetForm')
	->name('password.reset');

Route::get('inicio', 'HomeController@index')->name('home');

Route::group(['prefix' => 'usuarios', 'middleware' => ['auth', 'auth','role:admin']], function(){

    Route::get('editar/{id}', 'Auth\UsersController@viewEditUser')
    ->name('view_edit_user');

    Route::post('editar', 'Auth\UsersController@editUser')
    ->name('editUser');

    Route::get('registrar', 'Auth\RegisterController@showRegistrationForm')
    ->name('register');

    Route::post('registrar', 'Auth\RegisterController@register');

    Route::get('lista', 'Auth\UsersController@list')
    ->name('list_users');

});

Route::group(['prefix' => 'perfil', 'middleware' => ['auth']], function(){
    Route::get('/contrasena', 'Auth\UpdateProfile@viewUpdatePassword')
    ->name('viewUpdatePassword');

    Route::post('/contrasena', 'Auth\UpdateProfile@updatePassword')
    ->name('updatePassword');

    Route::get('/editar', 'Auth\UpdateProfile@viewUpdateProfile')
    ->name('viewUpdateProfile');

    Route::post('/editar', 'Auth\UpdateProfile@updateProfile')
        ->name('updateProfile');
});
