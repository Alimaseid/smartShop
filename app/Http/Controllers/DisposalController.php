<?php

namespace App\Http\Controllers;

use App\Models\Disposal;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\warehouse;
use Illuminate\Http\Request;

class DisposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:disposal-list|disposal-create|disposal-edit|disposal-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:disposal-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:disposal-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:disposal-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

        $disposals=Disposal::all();
        return view('pages.disposal.index',compact('disposals'));
    }
    public function create()
    {
        $warehouses= warehouse::all();
        $items = Item::orderBy('id', 'desc')
        ->where('isTrash', false)
        ->where('item_class', 'Stok Item')
        ->get();
        return view('pages.disposal.create',compact('items','warehouses'));
    }

    public function store(Request $request)
    {
         $request->validate([
             'warehouse_id' => 'required',
             'item_id' => 'required',
             'quantity' => 'required',
             'unit_price' => 'required',

         ]);

         $disposal=  new Disposal;
         $disposal->warehouse_id = $request->warehouse_id;
         $disposal->item_id = $request->item_id;
         $disposal->quantity = $request->quantity;
         $disposal->unit_price = $request->unit_price;
         $disposal->save();

         $inventory = Inventory::where('item_id', $request->item_id)
         ->where('warehouse_id', $request->warehouse_id)
         ->first();

     if ($inventory) {
         $inventory->quantity =  $inventory->quantity -$request->quantity;
         $inventory->update();
     }

         return redirect('/disposing')->with('success','Disposing Successful Saved.');
    }

    public function edit ($id)
    {
        $disposing = Disposal::find($id);
        $warehouses= warehouse::all();
        $items = Item::orderBy('id', 'desc')
        ->where('isTrash', false)
        ->where('item_class', 'Stok Item')
        ->get();
        return view('pages.disposal.edit',compact('items','warehouses','disposing'));
    }

    public function update(Request $request , Disposal $disposing)
    {
         $request->validate([
             'warehouse_id' => 'required',
             'item_id' => 'required',
             'quantity' => 'required',
             'unit_price' => 'required',

         ]);

         $disposal=  Disposal::find( $disposing->id);
         $disposal->warehouse_id = $request->warehouse_id;
         $disposal->item_id = $request->item_id;
         $disposal->quantity = $request->quantity;
         $disposal->unit_price = $request->unit_price;
         $disposal->save();
         return redirect('/disposing')->with('success','Disposing Successful Update.');
    }

    public function destroy(Disposal $disposing)
    {
        Disposal::where('id', $disposing->id)->delete();
        return back()->with('success','Disposal Successfuly Removed.');

    }

}
