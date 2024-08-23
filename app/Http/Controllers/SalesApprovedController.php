<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Sales;
use App\Models\SalesDetails;
use Illuminate\Http\Request;

class SalesApprovedController extends Controller
{
    //

    public function index()
    {

        $sales = Sales::all();
        $salesDetails = SalesDetails::all();
        return view('pages.SalesApproved.index', compact('sales', 'salesDetails'));
    }
    public function approve($id)
    {

        $sales = Sales::where('id', $id)->first();

        $sales->status = "Approved";
        $sales->update();

       
        $salesDetails= SalesDetails::where('sales_id',$sales->id)->get();
        foreach ($salesDetails as $salesDetail) {
            $inventory = Inventory::where('item_id', $salesDetail->item_id)
            ->where('warehouse_id', $sales->warehouse_id)
            ->first();

        if ($inventory) {
            $inventory->quantity =     $inventory->quantity - $salesDetail->quantity;
            $inventory->update();
        }
        }



        return back()->with('success', ' Sales Approved Done');
    }
}
