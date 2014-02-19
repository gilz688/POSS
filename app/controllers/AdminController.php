<?php
use Illuminate\Support\MessageBag;
class AdminController extends Controller {

    public function usersAction() {
        return View::make('admin/users', array(
                    'users' => Administration::getUsers(),
                    'username' => Auth::user()->username
        ));
    }

    public function addUserAction() {
        $errors = new MessageBag();
        $old = Input::old("errors");
        if ($old)
        {
            $errors = $old;
        }
        $data = ['errors' => $errors];
        if (Input::server('REQUEST_METHOD') == 'POST') {
            $errors = new MessageBag();
            $data = ['errors' => $errors];
            if (Input::get('password') === Input::get('confirm')) {
                $userData = [
                    'username' => Input::get('username'),
                    'password' => Input::get('password'),
                    'role' => Input::get('role')
                ];
                try {
                    Administration::createUser($userData);
                    return Redirect::route('users');
                } catch (ErrorException $ex) {
                    echo $ex->getMessage();
                }
            } else {
                $data['errors'] = new MessageBag([
                    'password' => [
                        'Password does not match.'
                    ]
                ]);
                $data['username'] = Input::get('username');
                return Redirect::route("users/add")
                                ->withInput($data);
            }
        }
        return View::make('admin/adduser', $data);
    }

    public function removeUserAction() {
        $userId = Input::get('userId');
        Administration::removeUser($userId);
        return Redirect::route('users');
    }

}
