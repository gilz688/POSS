<?php

/**
 * ApiSearchController is used for the "smart" search throughout the site.
 * it returns and array of items (with type and icon specified) so that the selectize.js plugin can render the search results properly
 * */
class SearchController extends Controller {

    public function appendValue($data, $type, $element) {
        // operate on the item passed by reference, adding the element and type
        foreach ($data as $key => & $item) {
            $item[$element] = $type;
        }
        return $data;
    }

    public function appendURL($data, $prefix) {
        // operate on the item passed by reference, adding the url based on slug
        foreach ($data as $key => & $item) {
            $item['url'] = url($prefix . '/' . $item['id']);
        }
        return $data;
    }

    public function index() {
        $query = Input::get('q', '');
        
        if (!$query && $query == '')
            return Response::json([], 400);

        if (Cache::has('q=' . $query)) {
            $data = Cache::get('q=' . $query);
            return Response::json([
                        'data' => $data
            ]);
        }

        $items = Item::where('itemName', 'ilike', '%' . $query . '%')
                ->orderBy('itemName', 'asc')
                ->take(5)
                ->get(['barcode', 'itemName'])
                ->toArray();

        $items = array_map(function($item) {
            return array(
                'name' => $item['itemName'],
                'id' => $item['barcode']
            );
        }, $items);

        $categories = ItemCategory::where('name', 'ilike', '%' . $query . '%')
                ->take(5)
                ->get(['id', 'name'])
                ->toArray();

        // Data normalization
        $categories = $this->appendValue($categories, url('images/category-icon.png'), 'icon');
        $items = $this->appendValue($items, url('images/product-icon.png'), 'icon');

        $items = $this->appendURL($items, 'items');
        $categories = $this->appendURL($categories, 'itemcategories');
        // Add type of data to each item of each set of results
        $items = $this->appendValue($items, 'item', 'class');
        $categories = $this->appendValue($categories, 'itemcategory', 'class');

        // Merge all data into one array
        $data = array_merge($items, $categories);
        
        $expiresAt = Carbon\Carbon::now()->addMinutes(5);
        Cache::put('q='.$query, $data, $expiresAt);

        return Response::json([
                    'data' => $data
        ]);
    }

    public function item(){
        $query = Input::get('q', '');
        
        if (!$query && $query == '')
            return Response::json([], 400);

        $items = Item::where('itemName', 'ilike', '%' . $query . '%')
                ->orderBy('itemName', 'asc')
                ->take(5)
                ->get(['barcode', 'itemName'])
                ->toArray();

        // Add type of data to each item of each set of results
        $items = $this->appendValue($items, 'itemName', 'class');

        // Merge all data into one array
        //$data = array_merge($items2, $items);
        
        return Response::json([
            'data' => $items
        ]);
    }

}
