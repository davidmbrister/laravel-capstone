<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class StoreController extends Controller
{
    // get public view for non-admin 
    public function getIndex()
    {
        $items = Item::paginate(10);

        return view('store.index')->withItems($items);
    }
    public function getSingle($slug)
    {
        //fetch record with slug
        $item = Item::where('slug', '=', $slug)->first();

        return view('blog.single')->withItem($item);
    }
}
