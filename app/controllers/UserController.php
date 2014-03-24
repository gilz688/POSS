<?php

class UserController extends Controller implements ResourceController {

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
        if(Request::ajax()){
            $paginator = $this->users->paginate(8);
            $options = [];
            $users = $paginator->getItems();
                    
            foreach($users as $user){
                $view = View::make('entry.user_option', ['id' => $user['id'] ]);
                $contents = (string) $view;  
                array_push($options, $contents);
            }
            
            return Response::json([
                'users' => $paginator->getCollection()->toJson(),
                'links' => $paginator->links()->render(),
                'options' => $options
            ]);
        }

        return View::make('user.index');
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

    public function update($id){

    }
}
