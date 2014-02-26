<?php

class UserController extends Controller {

    private $users;

    public function __construct(UserRepository $users) {
        $this->users = $users;
    }
    
    /**
     * Display a listing of users.
     *
     * @return Response
     */
    public function index() {
        return View::make('user.index', array(
                    'users' => $this->users->all(),
                    'username' => Auth::user()->username
        ));
    }

    /**
     * Remove the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $this->users->delete($id);
        return Redirect::route('users.index');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create() {
        return View::make('user.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @return Response
     */
    public function store() {
        try {
            $userData = [
                'username' => Input::get('username'),
                'password' => Input::get('password'),
                'role' => Input::get('role')
            ];
            $this->users->add($userData);
        } catch (UnauthorizedException $ex) {
            echo $ex->getMessage();
            return Redirect::route('users.create');
        }
        return Redirect::route('users.index');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        /*
        $userData = $this->users->find($id);
         */
        $userData = User::find($id)->attributesToArray();
        return View::make('user.edit', $userData);
    }
}
