<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\ItemPerStore;
use App\Models\PurchaseDetail;
use App\Models\Requisition;
use App\Models\VendorLedger;
use App\Models\warehouse;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:purchase-list|purchase-create|purchase-edit|purchase-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:purchase-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:purchase-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:purchase-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $purchases = Purchase::orderBy('id', 'desc')
            ->with('details')
            ->with('requisition:id,requisition_no')
            ->take(100)->get();
        $vendors = Vendor::orderBy('id', 'desc')->where('isTrash', false)->get();
        $items = Item::orderBy('id', 'desc')->where('isTrash', false)->get();
        $requisitions = Requisition::select('requisition_no')->get();

        return view('pages.purchase.purchase')
            ->with('items', $items)
            ->with('vendors', $vendors)
            ->with('requisitions', $requisitions)
            ->with('purchases', $purchases);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::orderBy('id', 'desc')->where('isTrash', false)->get();
        $vendors = Vendor::where('isTrash', false)->get();
        $locations = warehouse::where('location_type','ትልቁ መጋዘን')->get();
        $requisitions = Requisition::select('id', 'requisition_no')->get();
        return view('pages.purchase.add_order')
            ->with('vendors', $vendors)
            ->with('locations', $locations)
            ->with('requisitions', $requisitions)
            ->with('items', $items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request)
    {
        $purchase = Purchase::create([
            'vendor_id' => $request->vendor_id,
            'requisition_id' => $request->requisition_id,
            'invoice_no' => $request->invoice_no,
            'vendor_invoice_no' => $request->vendor_invoice_no,
            'remark' => $request->remark,
            'discount' => $request->discount,
            'warehouse_id' => $request->warehouse_id,
            'tax' => $request->tax,
        ]);

        $total = 0;

        foreach ($request->product_list as $product) {
            $this->createPurchaseDetail($purchase->id, $product, $request->warehouse_id);
            $total = $total + ($product['price'] * $product['quantity']);
            $inventory = Inventory::where('item_id', $product['item_id'])
                ->where('warehouse_id', $request->warehouse_id)
                ->first();

            if ($inventory) {
                $inventory->quantity =     $inventory->quantity + $product['quantity'];
                $inventory->update();
            } else {
                $inventory = new Inventory();
                $inventory->warehouse_id = $request->warehouse_id;
                $inventory->item_id = $product['item_id'];
                $inventory->quantity = $product['quantity'];
                $inventory->save();
            }
        }

        $sub = $total - ($total * $request->discount / 100);
        $grand_total =  $sub + ($sub * $request->tax / 100);
        $purchase->subtotal = $sub;
        $purchase->total = $grand_total;
        $purchase->save();


        // Balance adjustments
        $vendor = Vendor::find($request->vendor_id);
        $vendor->total_balance = $vendor->total_balance + $grand_total;
        $vendor->save();

        VendorLedger::create([
            'vendor_id' => $request->vendor_id,
            'in' => $grand_total,
            'purchase_id' => $purchase->id,
            'current_balance' => $vendor->total_balance,
        ]);

        return redirect('/purchase')->with('success', 'Purchase Successful Saved.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        $purchase =  Purchase::where('id', $purchase->id)
            ->with('details.item:id,name,unit')
            ->with('requisition:id,requisition_no')
            ->orderBy('id', 'desc')
            ->first();
        // return $purchase;
        $items = Item::where('isTrash', false)->get();
        $locations = warehouse::where('isTrash', false)->get();
        $vendors = Vendor::where('isTrash', false)->get();
        $requisitions = Requisition::select('id', 'requisition_no')->get();
        return view('pages.purchase.edit_purchase')
            ->with('purchase', $purchase)
            ->with('locations', $locations)
            ->with('vendors', $vendors)
            ->with('requisitions', $requisitions)
            ->with('items', $items);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {

        Purchase::where('id', $purchase->id)->update([
            'vendor_id' => $request->vendor_id,
            'requisition_id' => $request->requisition_id,
            'vendor_invoice_no' => $request->vendor_invoice_no,
            'remark' => $request->remark,
            'discount' => $request->discount,
            'warehouse_id' => $request->warehouse_id,
            'tax' => $request->tax,
        ]);

        PurchaseDetail::where('purchase_id', $purchase->id)->delete();

        $total = 0;

        foreach ($request->product_list as $product) {
            $this->createPurchaseDetail($purchase->id, $product, $request->warehouse_id);
            $total = $total + ($product['price'] * $product['quantity']);

        //     $inventory = Inventory::where('item_id', $product['item_id'])
        //     ->where('warehouse_id', $request->warehouse_id)
        //     ->first();

        // if ($inventory) {
        //     $oldData=$inventory->quantity;
        //     $newData=$inventory->quantity + $product['quantity'];
        //     $inventory->quantity = $newData - $oldData;
        //     $inventory->update();
        // }
        }

        $sub = $total - ($total * $request->discount / 100);
        $grand_total =  $sub + ($sub * $request->tax / 100);
        $purchase->subtotal = $sub;

        $deffrence = $purchase->total - $grand_total;

        $purchase->total = $grand_total;
        $purchase->save();


        // Balance adjustments
        $vendor = Vendor::find($request->vendor_id);
        $vendor->total_balance = $vendor->total_balance - $deffrence;
        $vendor->save();

        $ledger = VendorLedger::where('purchase_id', $purchase->id)->first();

        VendorLedger::where('purchase_id', $purchase->id)->update([
            'vendor_id' => $request->vendor_id,
            'in' => $grand_total,
            'purchase_id' => $purchase->id,
            'current_balance' => $ledger->current_balance - $deffrence,
        ]);

        $affected_ledger = VendorLedger::where('vendor_id', $vendor->id)->where('id', '>', $ledger->id)->get();
        if ($affected_ledger) {
            foreach ($affected_ledger as $affected) {
                $affected->current_balance = $affected->current_balance - $deffrence;
                $affected->save();
            }
        }


        return  redirect('/purchase')->with('success', 'Purchase Successfuly Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        PurchaseDetail::where('purchase_id', $purchase->id)->delete();
        $purchase->delete();
        return  redirect('/purchase')->with('success', 'Purchase Successfuly Removed.');
    }


    public function createPurchaseDetail($id, $product, $store)
    {
        PurchaseDetail::create([
            'purchase_id' => $id,
            'item_id' => $product['item_id'],
            'unit' => $product['unit'],
            'quantity' => $product['quantity'],
            'unit_price' => $product['price'],
            'total_price' => $product['quantity'] *  $product['price'],
        ]);

        $item = Item::find($product['item_id']);
        $item->quantity = $item->quantity + $product['quantity'];
        $item->cost_price = $product['price'];
        $item->save();

        $item_per_store = ItemPerStore::where('item_id', $product['item_id'])->where('store_id', $store)->first();
        if ($item_per_store) {
            $item_per_store->quantity = $item_per_store->quantity +  $product['quantity'];
            $item_per_store->save();
        } else {
            ItemPerStore::create([
                'item_id' => $product['item_id'],
                'store_id' => $store,
                'quantity' => $product['quantity'],
            ]);
        }
    }
}
