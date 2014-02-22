<?php

class Administration {

    public static function createUser($userData) {
        $rules = [ 'username' => 'required|Unique:users',
            'password' => 'required'];
        
        if (Auth::check() && Auth::user()->role == "admin") {
            $validator = Validator::make($userData, $rules);
            if ($validator->passes()) {
                $userData['password'] = Hash::make($userData['password']);
                $userId = User::create($userData)->id;
                return $userId;
            } else {
                throw new ErrorException("Invalid data!");
            }
        } else {
            throw new UnauthorizedException('User is not admin!');
        }
    }

    public static function removeUser($userId) {
        if (Auth::check() && Auth::user()->role == "admin") {
            $user = User::find($userId);
            if($user != null){
                $user->delete();
            }
            else{
                throw new ErrorException("Invalid userId!");
            }
        } else {
            throw new UnauthorizedException('User is not admin!');
        }
    }
    
    public static function getUsers(){
        if (Auth::check() && Auth::user()->role == "admin") {
            return User::all();
        } else {
            throw new UnauthorizedException('User is not admin!');
        }
    }
    
}