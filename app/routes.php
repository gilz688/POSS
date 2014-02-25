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

Route::group(["before" => "guest"], function() {
    Route::any("/", [
        "as" => "user/login",
        "uses" => "UserController@loginAction"
    ]);
    Route::any("/request", [
        "as" => "user/request",
        "uses" => "UserController@requestAction"
    ]);
    Route::any("/reset", [
        "as" => "user/reset",
        "uses" => "UserController@resetAction"
    ]);
});

Route::group(["before" => "auth"], function() {
    Route::any("/profile", [
        "as" => "user/profile",
        "uses" => "UserController@profileAction"
    ]);
    Route::any("/logout", [
        "as" => "user/logout",
        "uses" => "UserController@logoutAction"
    ]);
    Route::any("/users", [
        "as" => "users",
        "uses" => "AdminController@usersAction"
    ]);
    Route::any("/users/add", [
        "as" => "users/add",
        "uses" => "AdminController@addAction"
    ]);
    Route::get("/users/remove", [
        "as" => "users/remove",
        "uses" => "AdminController@deleteAction"
    ]);

    /*
     * ItemCategoryController
     */
    Route::resource('itemcategories', 'ItemCategoryController');

    /*
     * TransactionController
     */
    Route::get("/transactions", [
        "as" => "transactions",
        "uses" => "TransactionController@listAction"
    ]);
    Route::get("/transactions/void", [
        "as" => "transactions/void",
        "uses" => "TransactionController@voidAction"
    ]);
    Route::any("/transactions/add", [
        "as" => "transactions/add",
        "uses" => "TransactionController@addAction"
    ]);
    Route::any("/transactions/view", [
        "as" => "transactions/view",
        "uses" => "TransactionController@addAction"
    ]);

    /*
     * ItemController
     */
    Route::get("/items/add", [
        "as" => "items/add",
        "uses" => "ItemController@addItemAction"
    ]);
    Route::get("/items", [
        "as" => "items",
        "uses" => "ItemController@itemsAction"
    ]);
    Route::get("/items/remove", [
        "as" => "items/remove",
        "uses" => "ItemController@removeItemAction"
    ]);
    Route::resource('items', 'ItemController');
});
