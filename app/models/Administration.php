<?php

class Administration {

    private static function checkPermissions() {
        if (!Auth::check() || Auth::user()->role != "auditor" && Auth::user()->role != "admin") {
            throw new UnauthorizedException("User is not auditor or admin!");
        }
    }

    public static function createUser($userData) {
        self::checkPermissions();

        $rules = [ 'username' => 'required|Unique:users',
            'password' => 'required'];

        $validator = Validator::make($userData, $rules);
        if ($validator->passes()) {
            $userData['password'] = Hash::make($userData['password']);
            $userId = User::create($userData)->id;
            return $userId;
        } else {
            throw new ErrorException("Invalid data!");
        }
    }

    public static function removeUser($userId) {
        self::checkPermissions();
        $user = User::find($userId);
        if ($user != null) {
            $user->delete();
        } else {
            throw new ErrorException("Invalid userId!");
        }
    }

    public static function getUsers() {
        self::checkPermissions();
        return User::all();
    }

}

/**
 * Exception thrown when currently logged in user is not authorized to perform
 * specified operations.
 */
class UnauthorizedException extends Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}
