<?php
use Illuminate\Support\MessageBag;
class UserController
extends Controller
{
    public function loginAction()
    {
        $errors = new MessageBag();
        $old = Input::old("errors");
        if ($old)
        {
            $errors = $old;
        }
        $data = ['errors' => $errors];
        if (Input::server('REQUEST_METHOD') == 'POST')
        {
            $validator = Validator::make(Input::all(), [
                'username' => 'required',
                'password' => 'required'
            ]);
            if ($validator->passes())
            {
                $credentials = [
                    'username' => Input::get('username'),
                    'password' => Input::get('password')
                ];
                if (Auth::attempt($credentials))
                {
                    return Redirect::route('user/profile');
                }
            }
            $data['errors'] = new MessageBag([
                'password' => [
                    'Username and/or password invalid.'
                ]
            ]);
            $data['username'] = Input::get('username');
            return Redirect::route("user/login")
                ->withInput($data);
        }
        return View::make('user/login', $data);
    }
    
    public function logoutAction()
    {
        Auth::logout();
        return Redirect::route('user/login');
    }
    
    public function profileAction()
    {
        return View::make('user/profile');
    }
    
}