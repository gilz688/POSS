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

Route::group(["before" => "guest"], function() {
    Route::any("/login", [
        "as" => "login",
        "uses" => "SessionController@getLogin"
    ]);

    Route::post("/login", "SessionController@postLogin");
});

Route::group(["before" => "auth"], function() {
    Route::any("/", [
        "as" => "profile",
        "uses" => "SessionController@getProfile"
    ]);
    Route::any("/logout", [
        "as" => "logout",
        "uses" => "SessionController@getLogout"
    ]);

    /*
     * UserController
     */
    Route::resource('users', 'UserController');
    
    /*
     * ItemCategoryController
     */
    Route::resource('itemcategories', 'ItemCategoryController');

    /*
     * TransactionController
     */
    Route::resource('transactions', 'TransactionController'); 
    
	
    /*
     * ItemController
     */
    Route::resource('items', 'ItemController');

    /*
     * PurchasedItemController
     */
    Route::resource('purchaseditems', 'PurchasedItemController');

    Route::get("/report/sales","ReportController@getSalesReport");

    Route::post("/report/sales","ReportController@postSalesReport");

	// Display all clerk names
    Route::get('/report/clerkperformance', 'ReportController@displayAllClerk');

    // Display the clerk performance
    Route::resource('/report/clerk', 'ReportController');
	
    Route::get('/api/search','SearchController@index');

    
    // Display product sales
    Route::get('/report/product', 'ReportController@productsReport');
});
