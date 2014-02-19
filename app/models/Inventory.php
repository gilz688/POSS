<?php

class Inventory {

    private static function checkPermissions() {
        if (!Auth::check() || Auth::user()->role != "auditor" && Auth::user()->role != "admin") {
            throw new UnauthorizedException("User is not auditor or admin!");
        }
    }
    
    public static function createItemCategory($categoryData) {
        self::checkPermissions();
        $rules = [ 'name' => 'required',
            'description' => 'required'];

        $validator = Validator::make($categoryData, $rules);
        if ($validator->passes()) {
            $category = new ItemCategory;
            $category->name = $categoryData['name'];
            $category->description = $categoryData['description'];
            $category->save();
            return $category->id;
        } else {
            throw new ErrorException("Invalid data!");
        }
    }

    public static function removeItemCategory($categoryId) {
        self::checkPermissions();
        $category = ItemCategory::find($categoryId);
        if ($category != null) {
            $category->delete();
        } else {
            throw new ErrorException("Invalid userId!");
        }
    }
}
