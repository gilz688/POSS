<?php
Route::filter("auth", function()
{
    if (Auth::guest())
    {
        return Redirect::route("login");
    }
});
Route::filter("guest", function()
{
    if (Auth::check())
    {
        return Redirect::route("profile");
    }
});

Route::filter('csrf', function()
{
   $token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
   if (Session::token() != $token) {
      throw new Illuminate\Session\TokenMismatchException;
   }
});