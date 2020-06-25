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
//Route::resource('admin/users','AdminUsersController');
Route::get('/admin', function(){
    return view('admin.index');
});

//Route::get('/users/edit/{id}', 'AdminUsersController@edit');
Route::get('/users/edit/{id}', [ 'as' => 'admin.users.edit', 'uses' => 'AdminUsersController@edit']);

//for applying security to users, we created a middleware named Admin
//then added this middleware in kernel as admin
//then I am able to create a group function here to use Admin middleware
Route::group(['middleware'=>'admin'], function(){
    Route::resource('admin/users', 'AdminUsersController',[
    'names' => [
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        // etc...
    ]
]);
    Route::resource('admin/posts', 'AdminPostsController',[
        'names' => [
            'index' => 'admin.posts.index',
            'create' => 'admin.posts.create',
            // etc...
            ]
        ]);

    /*Route::get('/admin/users', function(){
        return view('admin.users.index');
    })->name('admin.users');*/
});
