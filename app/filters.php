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

Route::filter("csrf", function()
{
    if (Session::token() != Input::get("_token"))
    {
        throw new Illuminate\Session\TokenMismatchException;
    }
});