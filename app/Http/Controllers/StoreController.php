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
  /*
|--------------------------------------------------------------------------
| Public Store Views and Functions
|--------------------------------------------------------------------------
| Purpose : Here are general views for the store 'floor', including views to see
| all products, a single product, or products of a single category.
| 
| Functions : getIndex(), getSingle(), itemsByCategory()
|
*/
  public function getIndex()
  {
    // This function has side effects as well as return values
    // -- it sets the session vars and returns them as string vars to be used locally
    list($ipAddress, $clientID) = $this->checkForIpAndId();

    $items = Item::paginate(20);
    $categories = Category::all()->sortBy('name');

    return view('store.index')->withItems($items)->withCategories($categories);
  }

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
      ->where('category_id', $category_id) // i.e. where the passed in index == the category table's index
      ->get();

    return view('store.index')->withItems($items)->withCategories($categories);
  }
  /*
|--------------------------------------------------------------------------
| Shopping Cart Views and Functions
|--------------------------------------------------------------------------
|
| Purpose : Here are views and functions for the customer's 
| current shopping cart, including CRUD functionality and handling the purchase transaction.
| 
| Functions : orderIndex(), orderSingle(), cartIndex(), addToCart(), updateCart(), deleteItemFromCart(), checkOrder(), ThankYouPage()
| 
*/

  public function ordersIndex()
  {
     // receipt lines
     $orders = DB::table('order_info')
     ->get();
     return view('orders.index')->withRecords($orders);
  }
  public function orderSingle($order_id)
  {
     // receipt lines
     list($records, $total, $customerInfo) = $this->generateReceiptLines($order_id);

     return view('orders.orderSingle')->withRecords($records)->with('total', $total)->with('customer', $customerInfo);
  }
  public function cartIndex()
  {
    list($ipAddress, $clientID) = $this->checkForIpAndId();
    // get the item lines
    list($records, $total) = $this->generateCartLines();

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
      // increment quantity of existing record for this item type   
      // but not if it excedes the current inventory 
      $itemToIncrement = DB::table('shopping_cart')->where('item_id', $id)->first();
      //print("Updated Quantity".$itemToIncrement);
      //check that request->quantity is not greater than table('items')
      $inventory = DB::table('items')->where('id','=', $itemToIncrement->item_id)->first();
      if (($itemToIncrement->quantity+1) > $inventory->quantity) {
        // do not run database query
        Session::flash('failure', 'Requested amount excedes current inventory.');
        return redirect()->action('StoreController@cartIndex');
      }
      else
      {
        // total will not excede inventory quantity, so incrementing is safe
        DB::table('shopping_cart')
          ->where('item_id', $inventory->id)
          ->increment('quantity');
      }

    } else {
      $inventory = DB::table('items')->where('id','=', $id)->first();
      if ($inventory->quantity <= 0 ) {
        // do not run database query
        Session::flash('failure', 'Requested amount excedes current inventory.');
        return redirect()->action('StoreController@cartIndex');
      }
      // add new record for item of this type
      DB::table('shopping_cart')->insert(
        [
          'item_id' => $id, 'session_id' => $clientID, 'ip_address' => $ipAddress,
          'quantity' => $amount
        ]
      );
    }
    // join the item and shopping cart tables to pass to view
    $records = DB::table('shopping_cart')
      ->join('items', 'shopping_cart.item_id', '=', 'items.id')
      ->select('items.title', 'items.price', 'shopping_cart.quantity', 'shopping_cart.item_id')
      ->get();
    
    session()->now('success', 'The item was succesfully added to your order!');
    /* Session::flash('success', 'The item was succesfully added to your order!'); */

    // generate current cart total
    $total = 0;
    foreach ($records as $record) {
      $total += $record->price * $record->quantity;
    }
    // redirect to shoppingcart page in shop.shopping_cart
    // with all the data from that user's current order from their shopping_cart table 
    return view('store.shopping_cart')->withRecords($records)->with('total', $total);
    //return view('store.shopping_cart')->withRecords($records);

  }
  public function updateCart(Request $request)
  {

    if ($request->quantity == null || !(preg_match('/^[0-9]*$/',$request->quantity))) 
    {
      $records = DB::table('shopping_cart')
      ->join('items', 'shopping_cart.item_id', '=', 'items.id')
      ->select('items.title', 'items.price', 'shopping_cart.quantity', 'shopping_cart.item_id')
      ->get();
      
      $total = 0;
      foreach ($records as $record) {
        $total += $record->price * $record->quantity;
      }

      session()->now('failure', 'The quantity field requires a valid quantity.');
/*       Session::flash('failure', 'The quantity field requires a valid quantity'); */
      return view('store.shopping_cart')->withRecords($records)->with('total', $total);
    } else {

      list($ipAddress, $clientID) = $this->checkForIpAndId();

      //check that request->quantity is not greater than table('items')
      $inventory = DB::table('items')->where('id', $request->cart_id)->first();
      if ($request->quantity > $inventory->quantity) {
        // do not run database query
        Session::flash('failure', 'Requested amount excedes current inventory.');
        return redirect()->action('StoreController@cartIndex');
      } else {

        DB::table('shopping_cart')
          ->where('item_id', $inventory->id)
          ->update(['quantity' => $request->quantity]);
      }

      $records = DB::table('shopping_cart')
        ->join('items', 'shopping_cart.item_id', '=', 'items.id')
        ->select('items.title', 'items.price', 'shopping_cart.quantity', 'shopping_cart.item_id')
        ->get();

      $total = 0;
      foreach ($records as $record) {
      $total += $record->price * $record->quantity;
      }
      session()->now('success', 'Order successfully updated!');
      /* Session::flash('success', 'Order successfully updated!'); */
      return view('store.shopping_cart')->withRecords($records)->with('total', $total);
    }
  }

  public function deleteItemFromCart($id)
  {
    // Delete item from shoppingCart table by id
    DB::table('shopping_cart')->where('item_id', '=', $id)->delete();
    // redirect to shoppingcart page

    return redirect()->action('StoreController@cartIndex');
  }

  public function checkOrder(Request $request)
  {
    // ensure session has id and IP 
    list($ipAddress, $clientID) = $this->checkForIpAndId();
    // validate request fields
    $this->validate($request, ['fName'=>'required|string|max:50',
                                   'lName'=>'required|string|max:50',
                                   'phone'=>'required|string|max:50',
                                   'email'=>'email'
                                   ]); 
    
    //get shopping cart records
    $cartRecords = DB::table('shopping_cart')->get();
    // if the cart is empty, get out of this function. Redirect to store home. 
    if($cartRecords->isEmpty())
    {
      Session::flash('failure', 'There are no items in your cart. Order not completed.');
      return redirect()->action('StoreController@getIndex');

    }                              
    // add the order info to the order_info table, without the details which are detailed in the shoppingCart table?
     DB::table('order_info')->insert(
      [
        'fName' => $request->fName, 'lName' => $request->lName,
        'phone' => $request->phone, 'email' => $request->email,
        'session_id' => $clientID, 'ip_address' => $ipAddress
      ]
    );

    // get order id for insertion into items_sold
    $order_id = DB::table('order_info')->where('session_id', $clientID)->where('ip_address', $ipAddress)->where('fName',$request->fName)->where('lName', $request->lName)->value('order_id');
    print($order_id);
  
    foreach($cartRecords as $record) //DB::table('items_sold')->insert
    {
      //for each record in the shopping_cart table, move (not copy) into items_sold table with the order ID as the id
      $price = DB::table('items')->where('id', $record->item_id)->value('price');
      DB::table('items_sold')->insert(
        [
          'item_id' => $record->item_id, 'order_id' => $order_id, 'price' => $price,
          'quantity' => $record->quantity
        ]
      );

      //for each item line in the cart, remove the corresponding amount from the items table
      
     Item::find($record->item_id)->decrement('quantity', $record->quantity);  // Should probably redundantly check that this doesn't exceded inventory 
    }
    //don't clear the session yet, thank-you page needs it
    //$request->session()->flush();

    //clear shopping_cart table of entries from previous sessions
    DB::table('shopping_cart')->delete();

    session()->now('success', 'Order submitted!');
    // redirect to shoppingcart page
    return redirect()->route('shopping_cart.thank_you', $order_id);
  
  }

  public function ThankYouPage($order_id)
  {
    // check the current session id and IP to see if it matches what's in the orders tableand shopping cart table 
    if (session()->has('clientID') && session()->has('ipAddress')) 
    {
       // get the line items
      list($records, $total, $customerInfo) = $this->generateReceiptLines($order_id);

    }
    else // order voided, redirect to store index
    {
      session()->now('failure', 'Session timed out. Order not completed.');
      // there is no way the shopping cart could have data in its table at this point
      // therefore, the shopper's 'state' is fresh and clear of past activity on the site
      return redirect()->action('StoreController@cartIndex'); //go back to store
    }

    return view('store.thank_you')->withRecords($records)->with('total', $total)->with('customer', $customerInfo);
  }
  /*
|--------------------------------------------------------------------------
| Private Functions
|--------------------------------------------------------------------------
|
| Purpose : Convenience functions.
| Note : The two generateLines functions draw similar info from different tables depending on the point of the transaction 
| 
|
| Functions : generateReceiptLines(), generateCartLines(), checkForIpAndId()
| 
*/
  private function generateReceiptLines($order_id)
  {
    // receipt lines
    $records = DB::table('items_sold')
      ->where('order_id', $order_id)
      ->join('items', 'items_sold.item_id', '=', 'items.id')
      ->select('items.title', 'items.price', 'items_sold.quantity', 'items_sold.item_id')
      ->get();
    // get subtotal
    $total = 0;
    foreach ($records as $record) {
    $total += $record->price * $record->quantity;
    }
    // get customer info based on order_id
    $customerInfo = DB::table('order_info')->where('order_id', $order_id)->first();
    //return list 
    return [$records, $total, $customerInfo];
  }
  private function generateCartLines()
  {
    $records = DB::table('shopping_cart')
      ->join('items', 'shopping_cart.item_id', '=', 'items.id')
      ->select('items.title', 'items.price', 'shopping_cart.quantity', 'shopping_cart.item_id')
      ->get();

    $total = 0;
    foreach ($records as $record) {
      $total += $record->price * $record->quantity;
    }
    return [$records, $total];
  }
  // Add a check session function since it will be used often
  private function checkForIpAndId()
  {
    //session()->flush();
    if (session()->has('ipAddress') && session()->has('clientID')) {
      //print("firstIFstatement\n");
      $ipAddress = session('ipAddress');
      $clientID = session('clientID');
    } else if (session()->has('ipAddress')) // the middle two if statements are not necessary...
    {
      //print("secondIFstatement\n");
      // set the session in the session and copy into var to return
      $ipAddress = session('ipAddress');
      $clientID = session()->getID();
      session(['clientID' => $clientID]);
    } else if (session()->has('clientID')) {
      //print("thidIFstatement\n");
      // set the ipAddress in the session and copy into var to return
      $clientID = session('clientID');
      $ipAddress = request()->ip();
      session(['ipAddress' => $ipAddress]);
    } else {
      //print("lastIFstatement\n");
      // set both 
      $clientID = session()->getID();
      $ipAddress = request()->ip();

      //clear shopping_cart table of entries from previous sessions
      DB::table('shopping_cart')->delete();

      session(['clientID' => $clientID]);
      session(['ipAddress' => $ipAddress]);
    }
    //print("IF block exited\n");
    return [$ipAddress, $clientID];
  }
}
