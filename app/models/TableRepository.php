<?php

/*
 * Acts as an abstraction layer between Controllers and Databases
 */

interface TableRepository {
    public function add($attributes);
    public function delete($id);
    public function edit($id, $attributes);
    public function find($id);
    public function all(array $columns = ["*"]);
    public function paginate($limit = 10);
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

/**
 * Exception thrown when specified operation is not allowed
 */
class IllegalOperationException extends Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

/**
 * Exception thrown when parameter(s) are invalid.
 */
class InvalidException extends Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}