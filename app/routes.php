<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
Route::get('/', function()
{
	return View::make('hello');
});
*/

Route::group(["before" => "guest"], function()
{
    Route::any("/", [
        "as"   => "user/login",
        "uses" => "UserController@loginAction"
    ]);
    Route::any("/request", [
        "as"   => "user/request",
        "uses" => "UserController@requestAction"
    ]);
    Route::any("/reset", [
        "as"   => "user/reset",
        "uses" => "UserController@resetAction"
    ]);
});
Route::group(["before" => "auth"], function()
{
    Route::any("/profile", [
        "as"   => "user/profile",
        "uses" => "UserController@profileAction"
    ]);
    Route::any("/logout", [
        "as"   => "user/logout",
        "uses" => "UserController@logoutAction"
    ]);
    Route::any("/users", [
        "as"   => "users",
        "uses" => "AdminController@usersAction"
    ]);
    Route::any("/users/add", [
        "as"   => "users/add",
        "uses" => "AdminController@addUserAction"
    ]);
    Route::get("/users/remove", [
        "as"   => "users/remove",
        "uses" => "AdminController@removeUserAction"
    ]);
	
	Route::get("/items/index", [
		"as"   => "items",
		"uses" => "ItemController@index"
	]);
	Route::get("/items/create", [
		"as"   => "items/create",
		"uses" => "ItemController@create"
	]);
	Route::get("/items/store", [
		"as"   => "items/store",
		"uses" => "ItemController@store"
	]);
	Route::get("/items/show", [
		"as"   => "items/show",
		"uses" => "ItemController@show"
	]);
	Route::get("/items/destroy", [
		"as"   => "items/destroy",
		"uses" => "ItemController@destroy"
	]);
	
	
	Route::resource('items', 'ItemController');
});
