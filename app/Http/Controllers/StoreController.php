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

        return view('blog.index')->withItems($items);
    }
    public function getSingle($slug)
    {
        //fetch record with slug
        $post = Post::where('slug', '=', $slug)->first();

        return view('blog.single')->withPost($post);
    }
}
