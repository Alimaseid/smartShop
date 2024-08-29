<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sales;
use App\Models\Customer;
use App\Models\warehouse;
use App\Models\SalesDetails;
use Illuminate\Http\Request;
use App\Models\CustomerLedger;
use App\Http\Requests\StoreSalesRequest;
use App\Http\Requests\UpdateSalesRequest;
use App\Models\ItemPerStore;

class ServiceSalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:sales-list|sales-create|sales-edit|sales-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:sales-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:sales-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:sales-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $sales = Sales::orderBy('id', 'DESC')
            ->where('isServiceSales', true)
            ->get();
        return view('pages.sales.service.sales')->with('sales', $sales);
    }

    public function create()
    {
        $items = Item::orderBy('id', 'desc')
            ->where('isTrash', false)
            ->where('item_class', 'Stok Item')
            ->get();
        $customers = Customer::where('isTrash', false)->get();
        $locations = warehouse::where('isTrash', false)->get();

        return view('pages.sales.service.add_sales')
            ->with('items', $items)
            ->with('locations', $locations)
            ->with('customers', $customers);
    }

    public function edit(Sales $sales)
    {
        $sales =  Sales::where('id', $sales->id)
            ->with('details.item:id,name,unit')
            ->with('customer:id,name')
            ->orderBy('id', 'desc')
            ->first();
        // return $purchase;
        $items = Item::where('isTrash', false)->get();
        $locations = warehouse::where('isTrash', false)->get();
        $customers = Customer::where('isTrash', false)->get();
        return view('pages.sales.edit_sales')
            ->with('sales', $sales)
            ->with('locations', $locations)
            ->with('customers', $customers)
            ->with('items', $items);
    }

    public function store(StoreSalesRequest $request)
    {
        $sales = Sales::create([
            'customer_id' => $request->customer_id,
            'store_id' => $request->store_id,
            'invoice_no' => $request->invoice_no,
            'date' => $request->date,
            'sales_type' => $request->sales_type,
            'sub_total' => 0,
            'discount' => $request->discount,
            'vat' => $request->tax,
            'total' => 0,
            'remarks' => $request->remarks,
            'isServiceSales' => true
        ]);
        $sales->status= 'Pending';
        $sales->save();

        $sub_total = 0;
        foreach ($request->product_list as $product) {
            $this->newSalesDetail($sales->id, $product);
            $sub_total = $sub_total + ($product['price'] *  $product['quantity']);
        }

        $discount = $sub_total * $request->discount / 100;
        $net_total = $sub_total  - $discount;
        $tax = $net_total * $request->tax / 100;
        $total = $net_total + $tax;

        $sales->sub_total = $sub_total;
        $sales->total = $total;
        $sales->save();

        $this->customerBalance($sales->customer->id, $sales->id, $total, $request->remarks);

        return redirect('/service-sales')->with('success', 'Sales Done');;
    }


    // HELPRR FUNCTIONS FOR
    public function newSalesDetail($id, $product)
    {
        SalesDetails::create([
            'sales_id' => $id,
            'item_id' => $product['item_id'],
            'quantity' => $product['quantity'],
            'unit' => $product['unit'],
            'unit_price' => $product['price'],
            'total' => $product['price'] *  $product['quantity'],
        ]);
    }

    public function customerBalance($customer, $sales, $out, $remark)
    {
        $customer = Customer::find($customer);
        $customer->total_balance = $customer->total_balance + $out;
        $customer->save();

        CustomerLedger::create([
            'customer_id' => $customer->id,
            'out' => $out,
            'sales_id' => $sales,
            'current_balance' => $customer->total_balance,
            'reason' => $remark
        ]);
    }

    public function update(UpdateSalesRequest $request, Sales $sales)
    {
        Sales::where('id', $sales->id)->update([
            'customer_id' => $request->customer_id,
            'store_id' => $request->store_id,
            'invoice_no' => $request->invoice_no,
            'date' => $request->date,
            'sales_type' => $request->sales_type,
            'discount' => $request->discount,
            'vat' => $request->tax,
            'remarks' => $request->remarks,
        ]);

        $this->removeSalesDetail(SalesDetails::where('sales_id', $sales->id)->get(), $sales->store_id);

        $sub_total = 0;
        foreach ($request->product_list as $product) {
            $this->newSalesDetail($sales->id, $product, $request->store_id);
            $sub_total = $sub_total + ($product['price'] *  $product['quantity']);
        }

        $discount = $sub_total * $request->discount / 100;
        $net_total = $sub_total  - $discount;
        $tax = $net_total * $request->tax / 100;
        $total = $net_total + $tax;

        $deffrence = $sales->total - $total;

        $sales->sub_total = $sub_total;
        $sales->total = $total;
        $sales->save();

        // Balance adjustments
        $customer = Customer::find($request->customer_id);
        $customer->total_balance = $customer->total_balance - $deffrence;
        $customer->save();

        $ledger =  CustomerLedger::where('sales_id', $sales->id)->first();


        CustomerLedger::where('sales_id', $sales->id)->update([
            'customer_id' => $customer->id,
            'out' => $total,
            'sales_id' => $sales->id,
            'current_balance' => $ledger->current_balance - $deffrence,
        ]);


        $affected_ledger = CustomerLedger::where('customer_id', $customer->id)->where('id', '>', $ledger->id)->get();
        if ($affected_ledger) {
            foreach ($affected_ledger as $affected) {
                $affected->current_balance = $affected->current_balance - $deffrence;
                $affected->save();
            }
        }


        return redirect('/service-sales')->with('success', 'Sales Successfuly Updated.');
    }
    public function removeSalesDetail($detail, $store)
    {
        $sales_id = 0;
        foreach ($detail as $remove) {
            $item  = Item::find($remove->item_id);
            $item->quantity = $item->quantity + $remove->quantity;
            $item->save();

            $item_per_store = ItemPerStore::where('item_id', $remove->item_id)->where('store_id', $store)->first();
            if ($item_per_store) {
                $item_per_store->quantity = $item_per_store->quantity + $remove->quantity;
                $item_per_store->save();
            }

            $sales_id = $remove->sales_id;
        }

        SalesDetails::where('sales_id', $sales_id)->delete();
    }


    public function destroy($id)
    {

        SalesDetails::where('sales_id', $id)->delete();
        Sales::find($id)->delete();
        return  redirect('/service-sales')->with('success', ' Sales Successfuly Removed.');
    }
}
