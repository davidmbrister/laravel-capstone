<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;

class StoreController extends Controller
{
    // get public view for non-admin 
    public function getIndex()
    {
        $items = Item::paginate(20);
        $categories = Category::all()->sortBy('name');

        return view('store.index')->withItems($items)->withCategories($categories);
    }
    // I WANT TO ADD SLUGS -- REVIEW THIS
    public function getSingle($slug)
    {
        //fetch record with slug
        $item = Item::where('slug', '=', $slug)->first();

        return view('store.single')->withItem($item);
    }

    // This returns the same route but a different collection, so I think warrants another function
    public function itemsByCategory($category_id) 
    {    
        //when the category id is passed in with a foreach loop in the blade that iterates over the categories to make its list of links,
        // the category id passed in can be checked against 
        $categories = Category::all()->sortBy('name');
        $items = Item::select()
        ->where('category_id', $category_id ) // i.e. where the passed in index == the category table's index
        ->get();

        return view('store.index')->withItems($items)->withCategories($categories);
    }
}
