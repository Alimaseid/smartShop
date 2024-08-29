<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Category;
use App\Models\Vendor;
use App\Models\warehouse;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:item-list|item-create|item-edit|item-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:item-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:item-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:item-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $items = Item::orderBy('id','desc')->where('isTrash',false)->get();
        $vendors = Vendor::where('isTrash',false)->get();
        $warehouses= warehouse::all();
         return view('pages.item.items')
         ->with('vendors',$vendors)
         ->with('warehouses',$warehouses)
         ->with('items',$items);
    }

    public function add(){
        $vendors = Vendor::where('isTrash',false)->get();
        $categories = Category::all();
        return view('pages.item.add_item')
        ->with('categories',$categories)
        ->with('vendors',$vendors);
    }

    public function edit($id){
        $item = Item::with('vendor')->find($id);
        $vendors = Vendor::where('isTrash',false)->get();
        return view('pages.item.edit_item')
        ->with('vendors',$vendors)
        ->with('item',$item);
    }


    public function category(Request $request){
        $request->validate(['name'=>'required']);
        Category::create(['name'=>$request->name , 'description'=>$request->description]);
        return back()->with('success',$request->name.' Category created successfully');
    }

    public function deleteCategory($id)
    {
        Category::find($id)->delete();
        return back()->with('success','Category Removed successfully');

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        $request->validated($request->all());
        $item = Item::create($request->all());
        if($request->start_balance > 0){
            $item->quantity = $request->start_balance;
            $item->save();
        }
        return redirect('/items')->with('success','New Item Stored.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $request->validated($request->all());
        $item->update($request->all());
        $item->save();
        // return $item;
        return  redirect('/items')->with('success','Item Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->isTrash = true;
        $item->save();
        return back()->with('success','Item Deleted.');
    }
}
