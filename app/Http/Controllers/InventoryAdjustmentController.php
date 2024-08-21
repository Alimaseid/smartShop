<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryAdjustment;
use App\Models\Item;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InventoryAdjustmentController extends Controller
{

    public function index()
    {
        $adjustments = InventoryAdjustment::all();
        return view('pages.inventoryAdjustment.index', compact('adjustments'));
    }


    public function create()
    {
        $warehouses = warehouse::all();
        $items = Item::orderBy('id', 'desc')
        ->where('isTrash', false)
        ->where('item_class', 'Stok Item')
        ->get();
        return view('pages.inventoryAdjustment.create', compact('warehouses', 'items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warehouse_id' => 'required',
            'item_id' => 'required',
            'quantity' => 'required',


        ]);

        $adjustment =  new InventoryAdjustment();
        $adjustment->warehouse_id = $request->warehouse_id;
        $adjustment->item_id = $request->item_id;
        $adjustment->quantity =  $request->quantity;
        $adjustment->adjustment_type = 'CORRECTION';
        $adjustment->remarks = $request->remark;
        $adjustment->save();

        $item = Item::where('id', $adjustment->item_id)->first();
        $item->quantity = $adjustment->quantity;
        $item->update();
        $inventory = Inventory::where('item_id', $adjustment->item_id)
            ->where('warehouse_id', $adjustment->warehouse_id)
            ->first();

        if ($inventory) {
            $inventory->quantity = $adjustment->quantity;
            $inventory->update();
        } else {
            $inventory = new Inventory();
            $inventory->warehouse_id = $adjustment->warehouse_id;
            $inventory->item_id = $adjustment->item_id;
            $inventory->quantity = $adjustment->quantity;
            $inventory->save();
        }
        return Redirect('inventoryAdjustment')->with('success', 'Set Adjustment Successful Saved.');
    }

    public function edit($id)
    {
        $adjustments = InventoryAdjustment::find($id);
        $warehouses = warehouse::all();
        $items = Item::orderBy('id', 'desc')
        ->where('isTrash', false)
        ->where('item_class', 'Stok Item')
        ->get();
        return view('pages.inventoryAdjustment.edit', compact('adjustments', 'warehouses', 'items'));
    }

    public function setOpeningBalance($id)
    {
        $Id = $id;
        $item = Item::where('id', $Id)->first();

        $warehouses = warehouse::all();
        return view('pages.item.create_openingBalance', compact('Id', 'warehouses', 'item'));
    }

    public function update(Request $request, $Id)
    {
        $request->validate([
            'warehouse_id' => 'required',
            'item_id' => 'required',
            'quantity' => 'required',

        ]);

        $adjustment =   InventoryAdjustment::find($Id);
        $adjustment->warehouse_id = $request->warehouse_id;
        $adjustment->item_id = $request->item_id;
        $adjustment->quantity = $request->quantity ;
        $adjustment->adjustment_type = 'CORRECTION';
        $adjustment->remarks = $request->remark;
        $adjustment->save();
        $item = Item::where('id', $adjustment->item_id)->first();
        $item->quantity = $adjustment->quantity;
        $item->update();
        $inventory = Inventory::where('item_id', $adjustment->item_id)
            ->where('warehouse_id', $adjustment->warehouse_id)
            ->first();

        if ($inventory) {
            $inventory->quantity = $adjustment->quantity;
            $inventory->update();
        } else {
            $inventory = new Inventory();
            $inventory->warehouse_id = $adjustment->warehouse_id;
            $inventory->item_id = $adjustment->item_id;
            $inventory->quantity = $adjustment->quantity;
            $inventory->save();
        }

        return Redirect('inventoryAdjustment')->with('success', ' Adjustment Successful Saved.');
    }

    public function destroy($id)
    {
        InventoryAdjustment::find($id)->delete();
        return Redirect('inventoryAdjustment')->with('success', ' Adjustment Successful Deleted.');
    }

    public function openingBalance(Request $request, $id)
    {
        $request->validate([
            'warehouse_id' => 'required',
            'quantity' => 'required',
        ]);

        $adjustment =  new InventoryAdjustment();
        $adjustment->warehouse_id = $request->warehouse_id;
        $adjustment->item_id = $id;
        $adjustment->quantity = $request->quantity;
        $adjustment->adjustment_type = 'OPENNING_BALANCE';
        $adjustment->remarks = $request->remark;
        $adjustment->save();

        $item = Item::where('id', $adjustment->item_id)->first();
        $item->quantity = $adjustment->quantity;
        $item->update();
        $inventory = Inventory::where('item_id', $adjustment->item_id)
            ->where('warehouse_id', $adjustment->warehouse_id)
            ->first();

        if ($inventory) {
            $inventory->quantity = $adjustment->quantity;
            $inventory->update();
        } else {
            $inventory = new Inventory();
            $inventory->warehouse_id = $adjustment->warehouse_id;
            $inventory->item_id = $adjustment->item_id;
            $inventory->quantity = $adjustment->quantity;
            $inventory->save();
        }


        return Redirect('items')->with('success', 'Set opening Balance Successful Saved.');
    }
}
