<?php

class ItemCategoryController extends Controller{

    private $categories;

    public function __construct() {
        $this->categories = new ItemCategoryRepository;
    }

    public function categoriesAction() {
        return View::make('itemcategory/categories', array(
            'categories' => $this->categories->all()
        ));
    }
    
    public function deleteAction() {
        $categoryId = Input::get('categoryId');
        $this->categories->delete($categoryId);
        return Redirect::route('items/categories');
    }
    
    public function addAction() {
        if (Input::server('REQUEST_METHOD') == 'POST')
        {
            try{
                $categoryData = [
                    'name' => Input::get('name'),
                    'description' => Input::get('description'),
                ];
                $this->categories->add($categoryData);
                return Redirect::route('items/categories');
            } catch (UnauthorizedException $ex) {
                echo $ex->getMessage();
            }
        }
        
        return View::make('itemcategory/add');
    }

    public function editAction() {
        $categoryId = Input::get('categoryId');
        $categoryData = $this->categories->find($categoryId);
        
        if (Input::server('REQUEST_METHOD') == 'POST')
        {
            try{
                $categoryData = [
                    'name' => Input::get('name'),
                    'description' => Input::get('description'),
                ];
                $this->categories->edit($categoryId, $categoryData);
                return Redirect::route('items/categories');
            } catch (UnauthorizedException $ex) {
                echo $ex->getMessage();
            }
        }
        
        return View::make('itemcategory/edit', ['categoryId' => $categoryId, 'name' => $categoryData['name'], 'description' => $categoryData['description']]);
    }
}
