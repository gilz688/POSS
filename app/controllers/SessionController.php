<?php

use Illuminate\Support\MessageBag;

class SessionController extends Controller {

    public function postLogin() {
        $validator = Validator::make(Input::all(), [
                    'username' => 'required',
                    'password' => 'required'
        ]);
        if ($validator->passes()) {
            $credentials = [
                'username' => Input::get('username'),
                'password' => Input::get('password')
            ];
            if (Auth::attempt($credentials)) {
                return Redirect::route('profile');
            }
        }
        $data['errors'] = new MessageBag([
            'password' => [
                'Invalid username and/or password.'
            ]
        ]);
        $data['username'] = Input::get('username');
        return Redirect::route("login")
                        ->withInput($data);
    }

    public function getLogin() {
        $errors = new MessageBag();
        $old = Input::old("errors");
        if ($old) {
            $errors = $old;
        }
        $data = ['errors' => $errors];
        return View::make('session.login', $data);
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::route('login');
    }

    public function getProfile() {
        return View::make('session.profile');
    }

}
