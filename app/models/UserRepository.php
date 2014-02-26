<?php

class UserRepository implements TableRepository {

    private $categories;
    
    public function checkAdmin() {
        if (Auth::user()->role != 'admin') {
            throw new UnauthorizedException('Access is denied!');
        }
    }

    public function checkPermissions($id) {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->id != $id) {
            throw new UnauthorizedException('Access is denied!');
        }
    }

    public function add($attributes) {
        $this->checkAdmin();
        $rules = [ 'username' => 'required|Unique:users',
            'password' => 'required'];

        $validator = Validator::make($attributes, $rules);
        if ($validator->passes()) {
            $userData['password'] = Hash::make($attributes['password']);
            $userId = User::create($attributes)->id;
            return $userId;
        } else {
            throw new ErrorException("Invalid data!");
        }
    }

    public function all() {
        $this->checkAdmin();
        return User::orderBy('username')->get();
    }

    public function delete($id) {
        $this->checkAdmin();
        $user = User::find($id);
        if ($user != null) {
            $user->delete();
        } else {
            throw new ErrorException("Invalid userId!");
        }
    }

    public function edit($id, $attributes) {
        $this->checkPermissions($id);
        // some code here
    }

    public function find($id) {
        $this->checkPermissions($id);
        // some code here
    }
}