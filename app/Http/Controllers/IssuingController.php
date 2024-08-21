<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Issuing;
use App\Models\warehouse;
use App\Models\ItemPerStore;
use App\Models\IssuingDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreIssuingRequest;
use App\Http\Requests\UpdateIssuingRequest;
use App\Models\Employee;
use App\Models\Inventory;
use Illuminate\Support\Facades\Redirect;

class IssuingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issues = Issuing::orderby('id', 'desc')
            ->with('details')
            ->with('store')
            ->get();

        return view('pages.issuing.issuings')->with('issues', $issues);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::orderBy('id', 'desc')->where('isTrash', false)->get();
        $locations = warehouse::where('isTrash', false)->get();

        $employees = Employee::all();

        // return $employees;
        return view('pages.issuing.new_issuing')
            ->with('employees', $employees)
            ->with('locations', $locations)
            ->with('items', $items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIssuingRequest $request)
    {
        $issue = Issuing::create([
            'from' => $request->from,
            'issuing_no' => $request->issuing_no,
            'requested_by' => $request->requested_by,
            'date' => $request->date,
            'total_quantity' => $request->total,
            'remarks' => $request->remarks,
            'received_by' => $request->received_by
        ]);

        foreach ($request->product_list as $product) {
            IssuingDetails::create([
                'issuing_id' => $issue->id,
                'item_id' => $product['item_id'],
                'quantity' => $product['quantity'],
                'unit' => $product['unit'],
                'unit_price' => 'unknown',
            ]);
            $this->productPerStoreBalance($request->from, $product['item_id'], $product['quantity']);
            $inventory = Inventory::where('item_id', $product['item_id'])
                ->where('warehouse_id', $request->from)
                ->first();

            if ($inventory) {
                $inventory->quantity =  $inventory->quantity - $product['quantity'];
                $inventory->update();
            }
        }


        return redirect('/issuings')->with('success', 'Save');
    }

    /**
     * Display the specified resource.
     */
    public function show(Issuing $issuing) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issuing $issuing)
    {
        $issue = Issuing::with('details')->with('store')->where('id', $issuing->id)->first();
        $items = Item::orderBy('id', 'desc')->where('isTrash', false)->get();
        $locations = warehouse::where('isTrash', false)->get();
        return view('pages.issuing.edit_issuing')
            ->with('issue', $issue)
            ->with('locations', $locations)
            ->with('items', $items);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIssuingRequest $request, Issuing $issuing)
    {

        // remove old details
        $details = IssuingDetails::where('issuing_id', $issuing->id)->get();
        foreach ($details as $detail) {
            // simply revert the transfer location setter in order to avoid redundacy
            $this->setItemStoreBalance($issuing->from, $detail->item_id, $detail->quantity);
            $detail->delete();
        }

        $issuing->date =  $request->date;
        $issuing->from = $request->from;
        $issuing->issuing_no = $request->issuing_no;
        $issuing->requested_by = $request->requested_by;
        $issuing->total_quantity = $request->total;
        $issuing->remarks = $request->remarks;
        $issuing->received_by = $request->received_by;
        $issuing->save();

        // create a new details
        foreach ($request->product_list as $detail) {
            IssuingDetails::create([
                'issuing_id' => $issuing->id,
                'item_id' => $detail['item_id'],
                'quantity' => $detail['quantity'],
                'unit' => $detail['unit'],
                'unit_price' => 'unknown',
            ]);
            // simply revert the transfer location setter in order to avoid redundacy

            $this->subItemStoreBalance($issuing->from, $detail['item_id'], $detail['quantity']);
        }



        return redirect('/issuings')->with('success', 'Updated');
    }

    // helper function

    public function setItemStoreBalance($store, $item, $quantity)
    {
        $item_q = Item::find($item);
        $item_q->quantity = $item_q->quantity + $quantity;
        $item_q->save();
        $add =  ItemPerStore::where('store_id', $store)->where('item_id', $item)->first();
        if ($add) {
            $add->quantity = $add->quantity +  $quantity;
            $add->save();
        } else {
            ItemPerStore::create([
                'item_id' => $item,
                'store_id' => $store,
                'quantity' => $quantity,
            ]);
        }
    }

    public function subItemStoreBalance($store, $item, $quantity)
    {
        $item_q = Item::find($item);
        $item_q->quantity = $item_q->quantity - $quantity;
        $item_q->save();

        $sub =  ItemPerStore::where('store_id', $store)->where('item_id', $item)->first();
        if ($sub) {
            $sub->quantity = $sub->quantity -  $quantity;
            $sub->save();
        } else {
            ItemPerStore::create([
                'item_id' => $item,
                'store_id' => $store,
                'quantity' => -$quantity,
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        IssuingDetails::where('issuing_id', $id)->delete();
        Issuing::find($id)->delete();
        return  redirect('/issuings')->with('success', 'Store Issue Successfuly Removed.');
    }


    // helper functions

    public function productPerStoreBalance($store, $item, $quantity)
    {
        $product = Item::find($item);
        $product->quantity = $product->quantity - $quantity;
        $product->save();

        $item_per_store = ItemPerStore::where('item_id', $item)->where('store_id', $store)->first();
        if ($item_per_store) {
            $item_per_store->quantity = $item_per_store->quantity - $quantity;
            $item_per_store->save();
        } else {
            ItemPerStore::create([
                'item_id' => $item,
                'store_id' => $store,
                'quantity' => -$quantity
            ]);
        }
    }
}
