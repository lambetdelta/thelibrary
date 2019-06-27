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

Route::post('contraseña/recuperar', 'Auth\ResetPasswordController@reset')
->name('password.update');

Route::get('inicio', 'HomeController@index')->name('home');

Route::group(['prefix' => 'usuarios', 'middleware' => ['auth', 'auth']], function(){

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

Route::group(['prefix' => 'miembros', 'middleware' => ['auth']], function() {

    Route::get('list', "MemberController@list")
    ->name('member_list');

    Route::get('agregar', "MemberController@viewAdd")
    ->name('member_view_add');

    Route::post('agregar', "MemberController@add")
    ->name('member_add');

    Route::get('editar/{id}', "MemberController@viewEdit")
    ->name('member_view_edit');

    Route::post('editar', "MemberController@edit")
    ->name('member_edit');

    Route::get('borrar/{id}', "MemberController@viewDelete")
    ->name('member_view_delete');

    Route::post('borrar', "MemberController@delete")
    ->name('member_delete');

});

Route::group(['prefix' => 'categorias', 'middleware' => ['auth']], function() {

    Route::get('list', "CategoryController@list")
    ->name('category_list');

    Route::get('agregar', "CategoryController@viewAdd")
    ->name('category_view_add');

    Route::post('agregar', "CategoryController@add")
    ->name('category_add');

    Route::get('editar/{id}', "CategoryController@viewEdit")
    ->name('category_view_edit');

    Route::post('editar', "CategoryController@edit")
    ->name('category_edit');

    Route::get('borrar/{id}', "CategoryController@viewDelete")
    ->name('category_view_delete');

    Route::post('borrar', "CategoryController@delete")
    ->name('category_delete');
});

Route::group(['prefix' => 'libros', 'middleware' => ['auth']], function() {

    Route::get('list', "BookController@list")
    ->name('book_list');

    Route::get('agregar', "BookController@viewAdd")
    ->name('book_view_add');

    Route::post('agregar', "BookController@add")
    ->name('book_add');

    Route::get('editar/{id}', "BookController@viewEdit")
    ->name('book_view_edit');

    Route::post('editar', "BookController@edit")
    ->name('book_edit');

    Route::get('borrar/{id}', "BookController@viewDelete")
    ->name('book_view_delete');

    Route::post('borrar', "BookController@delete")
    ->name('book_delete');
});
Route::group(['prefix' => 'prestamos', 'middleware' => ['auth']], function() {


    Route::post('prestar', "BorrowingController@lend")
    ->name('lend');

    Route::post('devuelto', "BorrowingController@returnBook")
    ->name('return_book');
});
