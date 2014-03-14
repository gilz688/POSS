<?php

class ItemCategoryController extends Controller {

    private $categories;

    public function __construct(ItemCategoryRepository $categories) {
        $this->categories = $categories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return View::make('itemcategory.index', array(
                    'categories' => $this->categories->all()
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('itemcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $categoryData = [
            'name' => Input::get('name'),
            'description' => Input::get('description'),
        ];
        $rules = array(
            'name' => 'required|unique:item_categories',
            'description' => 'required',
        );
        $validator = Validator::make($categoryData, $rules);

        if ($validator->fails()) {
            return Redirect::to('itemcategories/create')
                            ->withErrors($validator)
                            ->withInput(Input::all());
        }
        $this->categories->add($categoryData);
        Session::flash('message', 'Successfully added new item category!');
        return Redirect::route('itemcategories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $categoryData = $this->categories->find($id);
        return View::make('itemcategory.edit', $categoryData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $categoryData = [
            'name' => Input::get('name'),
            'description' => Input::get('description'),
        ];
        $rules = [
            'name' => 'required|unique:item_categories',
            'description' => 'required',
        ];
        $validator = Validator::make($categoryData, $rules);
        if ($validator->fails()) {
            return Redirect::to('itemcategories/' . $id . '/edit')
                            ->withErrors($validator)
                            ->withInput(Input::all());
        }
        $this->categories->edit($id, $categoryData);
        return Redirect::route('itemcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $this->categories->delete($id);
        return Redirect::route('itemcategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        
    }
}
