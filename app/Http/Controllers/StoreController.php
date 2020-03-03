<?php
// AKA the public controller, session handling will happen in here
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{
    // get public view for non-admin 
    public function getIndex()
    {
      // this function has side effects as well as return values -- it sets the session vars and returns them as string vars
        list($ipAddress, $clientID) = $this->checkForIpAndId(); 

        //dd($ipAddress, $clientID);

        $items = Item::paginate(20);
        $categories = Category::all()->sortBy('name');

        return view('store.index')->withItems($items)->withCategories($categories);
    }
    // Slugs successfully added
    public function getSingle($slug)
    {
        list($ipAddress, $clientID) = $this->checkForIpAndId();
        //fetch record with slug
        $item = Item::where('slug', '=', $slug)->first();

        return view('store.single')->withItem($item);
    }

    // This returns the same route but a different collection, so I think warrants another function
    public function itemsByCategory($category_id) 
    {    
        list($ipAddress, $clientID) = $this->checkForIpAndId();
        //when the category id is passed in with a foreach loop in the blade that iterates over the categories to make its list of links,
        // the category id passed in can be checked against 
        $categories = Category::all()->sortBy('name');
        $items = Item::select()
        ->where('category_id', $category_id ) // i.e. where the passed in index == the category table's index
        ->get();
        
        return view('store.index')->withItems($items)->withCategories($categories);
      }

      public function cartIndex()
      {
        list($ipAddress, $clientID) = $this->checkForIpAndId();

        $records = DB::table('shopping_cart')
            ->join('items', 'shopping_cart.item_id', '=', 'items.id')            
            ->select('items.title', 'items.price', 'shopping_cart.quantity', 'shopping_cart.item_id')
            ->get();
            print($records);

        $total = 0;
        foreach ($records as $record) {
         $total += $record->price * $record->quantity;
        }
        /* dd($total); */

        // redirect to shoppingcart page in shop.shopping_cart
        // with all the data from that user's current order from their shopping_cart table 
        return view('store.shopping_cart')->withRecords($records)->with('total', $total); 
      }
    // An addToCart function that accepts an array of session data 
    // -- the private function addToCart will use the variables obtained from checkForIpandID();
      public function addToCart($id, $amount)
      {
        // get the ip address and session ID 
        list($ipAddress, $clientID) = $this->checkForIpAndId();
       
        // Condition to see if the table has a record by this $id param
        if (DB::table('shopping_cart')->where('item_id', $id)->exists())
        {
          print("Shopping Cart table already has this item");
          // increment quantity of existing record for this item type  
          DB::table('shopping_cart')->where('item_id', $id)->increment('quantity');
        } else
        {
          print("Shopping Cart table DOES NOT already have this item");
          // add new record for item of this type
          DB::table('shopping_cart')->insert(
            [
              'item_id' => $id, 'session_id' => $clientID, 'ip_address' => $ipAddress,
              'quantity' => $amount
            ]
            );
        }

        // join the item and shopping cart tables
        $records = DB::table('shopping_cart')
            ->join('items', 'shopping_cart.item_id', '=', 'items.id')            
            ->select('items.title', 'items.price', 'shopping_cart.quantity', 'shopping_cart.item_id')
            ->get();
            print($records);

        Session::flash('success', 'The item was succesfully added to your order!');

        $total = 0;
        foreach ($records as $record) {
         $total += $record->price * $record->quantity;
        }
        /* dd($total); */

        // redirect to shoppingcart page in shop.shopping_cart
        // with all the data from that user's current order from their shopping_cart table 
        return view('store.shopping_cart')->withRecords($records)->with('total', $total); 
        //return view('store.shopping_cart')->withRecords($records);
          
      }
    public function updateCart(Request $request)
    {
      // take the given id
       /* $this->validate($request, ['quantity'=>'required|min:1']);  */
      print('HIIIIIIIIIIIII');
     
      if ($request->quantity == null)
      {
        Session::flash('message','The quantity field requires a valid quantity');
        
      } else{
        Session::flash('success', 'non-null value registered');
      }

      /*The quantity is updated in the associated controller method (do not exceed item quantity in the database),
       and you are redirected back to the shopping cart*/
      print($request->cart_id);
      list($ipAddress, $clientID) = $this->checkForIpAndId();

      // FINAL UPDATE CART PIECE
        //check that request->quantity is not greater than table('items')
        $inventory = DB::table('items')->where('id', $request->cart_id)->first();
        if($request->quantity > $inventory->quantity)
        {
          // do not run database query
          
          /* dd($inventory); */
          Session::flash('success', 'Requested amount excedes current inventory.');
          return redirect()->action('StoreController@cartIndex');
        } 
        else {
          
          DB::table('items')
                ->where('id', $request->cart_id)
                ->decrement('quantity', $request->quantity);
        }

        $records = DB::table('shopping_cart')
            ->join('items', 'shopping_cart.item_id', '=', 'items.id')            
            ->select('items.title', 'items.price', 'shopping_cart.quantity', 'shopping_cart.item_id')
            ->get();
            print($records);
       
            $total = 0;
            foreach ($records as $record) {
             $total += $record->price * $record->quantity;
            }
            /* dd($total); */
    
            // redirect to shoppingcart page in shop.shopping_cart
            // with all the data from that user's current order from their shopping_cart table 
            return view('store.shopping_cart')->withRecords($records)->with('total', $total); 
      
    }
    public function deleteItemFromCart($id)
    {
      // Delete item from shoppingCart table by id
      DB::table('shopping_cart')->where('item_id', '=', $id)->delete();
      // redirect to shoppingcart page

      return redirect()->action('StoreController@cartIndex');
    }



















    // Add a check session function since it will be used often
    private function checkForIpAndId() 
    
    {
      //session()->flush();
      if (session()->has('ipAddress') && session()->has('clientID') )
      {
        print("firstIFstatement\n");
        $ipAddress = session('ipAddress');
        $clientID = session('clientID');

      } else if (session()->has('ipAddress')) // the middle two if statements are not necessary...
      {
        print("secondIFstatement\n");
        // set the session in the session and copy into var to return
        $ipAddress = session('ipAddress');
        $clientID = session()->getID();
        session(['clientID' => $clientID]);
        
      } else if (session()->has('clientID'))
      {
        print("thidIFstatement\n");
        // set the ipAddress in the session and copy into var to return
        $clientID = session('clientID');
        $ipAddress = request()->ip();
        session(['ipAddress' => $ipAddress]);

      } else
      {
        print("lastIFstatement\n");
        // set both 
        $clientID = session()->getID();
        $ipAddress = request()->ip();

        //clear shopping_cart table of entries from previous sessions
        DB::table('shopping_cart')->delete();

        session(['clientID' => $clientID]);
        session(['ipAddress' => $ipAddress]);
      }
      print("IF block exited\n");
      return [$ipAddress, $clientID];
    }

}
