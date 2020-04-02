<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use Image;
use Storage;
use Session;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('id','ASC')->paginate(10);
        return view('items.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->sortBy('name');
        return view('items.create')->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        //dd(storage_path());;
        //validate the data
        // if fails, defaults to create() passing errors
        $this->validate($request, ['title'=>'required|string|max:255',
                                   'category_id'=>'required|integer|min:0',
                                   'description'=>'required|string',
                                   'price'=>'required|numeric',
                                   'quantity'=>'required|integer',
                                   'sku'=>'required|string|max:100',
                                   'slug'=>'required|alpha-dash|min:5|max:255|unique:items',                                   
                                   'picture' => 'required|image']); 

        //send to DB (use ELOQUENT)
        $item = new Item;
        $item->title = $request->title;
        $item->category_id = $request->category_id;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        $item->sku = $request->sku;
        $item->slug = $request->slug;

        //TODO: imageIntervention has been installed so create a large image and a smaller image; 
        //save image
        if ($request->hasFile('picture')) {
        
            $image = $request->file('picture');
            //tn_
            $sharedTime = time();
            $sharedFileName = $sharedTime . '.' . $image->getClientOriginalExtension();
            $filename1 = 'tn_' . $sharedTime . '.' . $image->getClientOriginalExtension();
            $location ='images/items/' . $filename1;
            
            $imageSmall = Image::make($image)->resize(120, 180);

            Storage::disk('public')->put($location, (string) $imageSmall->encode());

            // single database name for both as they have predictable prefixes
            $item->picture = $sharedFileName;

            //lrg_
            $filename2 = 'lrg_' . $sharedTime . '.' . $image->getClientOriginalExtension();
            $imageLarge = Image::make($image)->resize(240, 360);
            $location ='images/items/' . $filename2;
            Storage::disk('public')->put($location, (string) $imageLarge->encode());

        }

        $item->save(); //saves to DB

        Session::flash('success','The item has been added');

        //redirect
        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::all()->sortBy('name');
        return view('items.edit')->with('item',$item)->with('categories',$categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate the data
        // if fails, defaults to create() passing errors
        $item = Item::find($id);
        $this->validate($request, array(
          'title'=>'required|string|max:255',
          'category_id'=>'required|integer|min:0',
          'description'=>'required|string',
          'price'=>'required|numeric',
          'quantity'=>'required|integer',
          'sku'=>'required|string|max:100',

          'slug' => ['required', 'alpha_dash', 'min:5', 'max:255',
          Rule::unique('items')->ignore($request->slug, 'slug')],
          'picture' => 'sometimes|image'
         ));
/*         $this->validate($request, ['title'=>'required|string|max:255',
                                   'category_id'=>'required|integer|min:0',
                                   'description'=>'required|string',
                                   'price'=>'required|numeric',
                                   'quantity'=>'required|integer',
                                   'sku'=>'required|string|max:100',
                                   'slug'=>['required|alpha-dash|min:5|max:255|unique:items',
                                   Rule::unique('items')->ignore($request->slug, 'slug')],
                                   'picture' => 'sometimes|image']);   */           

        //send to DB (use ELOQUENT)
        $item->title = $request->title;
        $item->category_id = $request->category_id;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        $item->sku = $request->sku;
        $item->slug = $request->slug;
        
        // TODO: imageIntervention has been installed so create a large image and a smaller image; 
        // then hook the small picture up to the thumbnail view and the large one to the product (single) view
        //save image
        if ($request->hasFile('picture')) {
          
            $image = $request->file('picture');
            //tn_ and lrg_
            //tn_
            $sharedTime = time();
            $sharedFileName = $sharedTime . '.' . $image->getClientOriginalExtension();
            $filename1 = 'tn_' . $sharedTime . '.' . $image->getClientOriginalExtension();
            //dd($filename1);
            $location ='images/items/' . $filename1;
            
            $imageSmall = Image::make($image)->resize(120, 180);

            Storage::disk('public')->put($location, (string) $imageSmall->encode());
          
            //lrg_
            $filename2 = 'lrg_' . $sharedTime . '.' . $image->getClientOriginalExtension();
            $imageLarge = Image::make($image)->resize(240, 360);
            $location ='images/items/' . $filename2;
            Storage::disk('public')->put($location, (string) $imageLarge->encode());
            
            if (isset($item->picture)) {
              $oldFilename1 = 'tn_' . $item->picture;
              $oldFilename2 = 'lrg_' .$item->picture;
              
              Storage::disk('public')->delete(['images/items/'.$oldFilename1, 'images/items/'.$oldFilename2]);                 
            }
            
            // single database name for both as they have predictable prefixes
            $item->picture = $sharedFileName;
        }

        $item->save(); //saves to DB

        Session::flash('success','The item has been updated');

        //redirect
        return redirect()->route('items.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if (isset($item->picture)) {
          $oldFilename1 = 'tn_' . $item->picture;
          $oldFilename2 = 'lrg_' .$item->picture;
          
          Storage::disk('public')->delete(['images/items/'.$oldFilename1, 'images/items/'.$oldFilename2]);                
          
        }
        $item->delete();

        Session::flash('success','The item has been deleted');

        return redirect()->route('items.index');

    }
}
