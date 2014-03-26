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

    public function all(array $columns = ["*"]) {
        $this->checkAdmin();
        return User::orderBy('username')->get($columns);
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
        $user = User::find($id);
        if ($id == null) {
            throw new ErrorException("Invalid id!");
        } else {
            if(array_key_exists('username',$attributes)){
                $username = $attributes['username'];
                if(gettype($username) == 'string'){
                    $user->username = $attributes['username'];
                }
                else{
                    throw new ErrorException('Username should be a string!');
                }
            }
            if(array_key_exists('password',$attributes)){
                $password = $attributes['password'];
                if(gettype($password) == 'string'){
                    $user->password = Hash::make($attributes['password']);
                }
                else{
                    throw new ErrorException('Password should be string!');
                }
            }
            $user->update();
        }
    }

    public function find($id) {
        $this->checkPermissions($id);
        $user = User::find($id);
        if($user == null){
            return null;
        }
        return $user->attributesToArray();
    }
	
	public function displayClerk($limit = 5) {
        return User::where('role','=', 'clerk')->paginate($limit);
    }

    public function paginate($limit = 10){
        $items = User::paginate($limit);
        return $items;
    }
}


