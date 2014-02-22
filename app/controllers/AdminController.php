<?php

class AdminController extends Controller {

    public function usersAction() {
        return View::make('admin/users', array(
                    'users' => Administration::getUsers(),
                    'username' => Auth::user()->username
        ));
    }
    
    public function addAction() {
        if (Input::server('REQUEST_METHOD') == 'POST')
        {
            try{
                $userData = [
                    'username' => Input::get('username'),
                    'password' => Input::get('password'),
                    'role' => Input::get('role')
                ];
                Administration::createUser($userData);
                return Redirect::route('users');
            } catch (UnauthorizedException $ex) {
                echo $ex->getMessage();
            }
        }
        
        return View::make('admin/adduser');
    }
    
    public function deleteAction() {
        $userId = Input::get('userId');
        Administration::removeUser($userId);
        return Redirect::route('users');
    }

}
