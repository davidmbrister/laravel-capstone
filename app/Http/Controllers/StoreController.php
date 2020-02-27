<?php
// AKA the public controller, session handling will happen in here
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use Session;

class StoreController extends Controller
{
    // get public view for non-admin 
    public function getIndex()
    {
      /* $clientIP = request()->ip();
      $session_id = session()->getId();
    */
    $ipAddress = "";
    $clientID = "";
      list($ipAddress, $clientID) = $this->checkForIpAndId(); // this function has side effects as well as return values -- it sets the session vars and returns them as string vars

      dd($ipAddress, $clientID);

        $items = Item::paginate(20);
        $categories = Category::all()->sortBy('name');

        return view('store.index')->withItems($items)->withCategories($categories);
    }
    // Slugs successfully added
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
    // Add a check session function since it will be used often
    private function checkForIpAndId()
    {
      if (session()->has('ipAddress') && session()->has('sessiondID') )
      {
        print("firstIFstatement\n");
        $ipAddress = session('ipAddress');
        $clientID = session('sessionID');

      } else if (session()->has('ipAddress'))
      {
        print("secondIFstatement\n");
        // set the session in the session and copy into var to return
        $ipAddress = session('ipAddress');
        $clientID = session()->getID();
        session(['clientID' => $clientID]);
        
      } else if (session()->has('sessionID'))
      {
        print("thidIFstatement\n");
        // set the ipAddress in the session and copy into var to return
        $clientID = session('sessionID');
        $ipAddress = request()->ip();
        session(['ipAddress' => $ipAddress]);

      } else
      {
        print("lastIFstatement\n");
        // set both 
        $clientID = session()->getID();
        $ipAddress = request()->ip();

        session(['clientID' => $clientID]);
        session(['ipAddress' => $ipAddress]);
      }
      print("IF block exited\n");
      return [$ipAddress, $clientID];
    }
    // An addToCart function that accepts an array of session data
}
