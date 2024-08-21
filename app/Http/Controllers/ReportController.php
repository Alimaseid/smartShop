<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CustomerLedger;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\PurchaseDetail;
use App\Models\SalesDetails;
use App\Models\VendorLedger;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function salesSummary()
    {

        $all_ledger = CustomerLedger::with('customer:id,name,total_balance')
            ->with('sales:id,vat,sub_total')
            ->orderBy('id', 'desc')
            ->get();
        $ledgers =  collect($all_ledger)->groupBy('customer_id');
        $summary = [];
        foreach ($ledgers as $key => $ledger) {
            $vat = 0;
            $amount_to_collect = 0;
            $customer_name = '';
            foreach ($ledger as $customer) {
                $customer_name = $customer->customer->name;
                if ($customer->in == null) {
                    $vat = $vat + ($customer->sales->sub_total * $customer->sales->vat / 100);
                }
                $amount_to_collect =  $customer->customer->total_balance;
            }

            $summary[] = [
                'customer' => $customer_name,
                'service_amount' => $ledger->sum('out') - $vat,
                'tax' => $vat,
                'total' => $ledger->sum('out'),
                'paid_amount' => $ledger->sum('in'),
                'amount_to_collect' => $amount_to_collect,
            ];
        }
        // return $ledgers;
        // return $summary;


        return view('pages.report.sales_summary')
            ->with('date', null)
            ->with('summary', $summary);
    }



    public function getSalesSummaryByDate(Request $request)
    {
        $request->validate(['daterange' => 'required']);

        $start_date =  Carbon::parse(Str::before($request->daterange, '-'));
        $end_date =  Carbon::parse(Str::after($request->daterange, '-'));

        $all_ledger = CustomerLedger::with('customer:id,name,total_balance')
            ->with('sales:id,vat,sub_total')
            ->whereBetween('created_at', [$start_date, $end_date->addDay()])
            ->orderBy('id', 'desc')
            ->get();
        $ledgers =  collect($all_ledger)->groupBy('customer_id');
        $summary = [];
        foreach ($ledgers as $key => $ledger) {
            $vat = 0;
            $amount_to_collect = 0;
            $customer_name = '';
            foreach ($ledger as $customer) {
                $customer_name = $customer->customer->name;
                if ($customer->in == null) {
                    $vat = $vat + ($customer->sales->sub_total * $customer->sales->vat / 100);
                }
                $amount_to_collect =  $customer->customer->total_balance;
            }

            $summary[] = [
                'customer' => $customer_name,
                'service_amount' => $ledger->sum('out') - $vat,
                'tax' => $vat,
                'total' => $ledger->sum('out'),
                'paid_amount' => $ledger->sum('in'),
                'amount_to_collect' => $amount_to_collect,
            ];
        }
        // return $ledgers;
        // return $summary;


        return view('pages.report.sales_summary')
            ->with('date', $request->daterange)
            ->with('summary', $summary);
    }



    public function purchaseSummary()
    {
        $all_ledger = VendorLedger::with('vendor:id,name,total_balance')
            ->with('purchase:id,tax,subtotal')
            ->orderBy('id', 'desc')
            ->get();
        $ledgers =  collect($all_ledger)->groupBy('vendor_id');
        $summary = [];
        foreach ($ledgers as $key => $ledger) {
            $vat = 0;
            $payable_amount = 0;
            $vendor_name = '';
            foreach ($ledger as $lg) {
                $vendor_name = $lg->vendor->name;
                if ($lg->in != null) {
                    $vat = $vat + ($lg->purchase->subtotal * $lg->purchase->tax / 100);
                }
                $payable_amount =  $lg->vendor->total_balance;
            }

            $summary[] = [
                'vendor' => $vendor_name,
                'service_amount' => $ledger->sum('in') - $vat,
                'tax' => $vat,
                'total' => $ledger->sum('in'),
                'paid_amount' => $ledger->sum('in'),
                'payable_amount' => $payable_amount,
            ];
        }
        // return $ledgers;
        // return $summary;

        return view('pages.report.purchase_summary')
            ->with('date', null)
            ->with('summary', $summary);
    }

    public function getPurchaseSummaryByDate(Request $request)
    {
        $request->validate(['daterange' => 'required']);

        $start_date =  Carbon::parse(Str::before($request->daterange, '-'));
        $end_date =  Carbon::parse(Str::after($request->daterange, '-'));

        $all_ledger = VendorLedger::with('vendor:id,name,total_balance')
            ->with('purchase:id,tax,subtotal')
            ->whereBetween('created_at', [$start_date, $end_date->addDay()])
            ->orderBy('id', 'desc')
            ->get();
        $ledgers =  collect($all_ledger)->groupBy('vendor_id');
        $summary = [];
        foreach ($ledgers as $key => $ledger) {
            $vat = 0;
            $payable_amount = 0;
            $vendor_name = '';
            foreach ($ledger as $vendor) {
                $vendor_name = $vendor->vendor->name;
                if ($vendor->in != null) {
                    $vat = $vat + ($vendor->purchase->sub_total * $vendor->purchase->tax / 100);
                }
                $payable_amount =  $vendor->vendor->total_balance;
            }

            $summary[] = [
                'vendor' => $vendor_name,
                'service_amount' => $ledger->sum('in') - $vat,
                'tax' => $vat,
                'total' => $ledger->sum('in'),
                'paid_amount' => $ledger->sum('out'),
                'payable_amount' => $payable_amount,
            ];
        }
        // return $ledgers;
        // return $summary;

        return view('pages.report.purchase_summary')
            ->with('date', null)
            ->with('summary', $summary);
    }



    public function itemSummary()
    {
        $salesDetial =   collect(SalesDetails::with('item:id,name')->get())->groupBy('item_id');
        $purchaseDetial =   collect(PurchaseDetail::with('item:id,name')->get())->groupBy('item_id');

        // get purchase item summary
        $purchase_summary = [];
        foreach ($purchaseDetial as $purchases) {
            $item_name = '';
            $quantity = 0;
            $total = 0;
            foreach ($purchases as $purchase) {
                $item_name = $purchase->item->name;
                $quantity = $quantity + $purchase->quantity;
                $total = $total + $purchase->total_price;
            }

            $purchase_summary[]  = [
                'item_name' => $item_name,
                'purchase_quantity' => $quantity,
                'purchase_total' => $total,
            ];
        }


        // get sales item summary

        $sales_summary = [];
        foreach ($salesDetial as $sales) {
            $item_name = '';
            $quantity = 0;
            $total = 0;
            foreach ($sales as $sale) {
                $item_name = $sale->item->name;
                $quantity = $quantity + $sale->quantity;
                $total = $total + $sale->total;
            }

            $sales_summary[]  = [
                'item_name' => $item_name,
                'sales_quantity' => $quantity,
                'sales_total' => $total,
            ];
        }

        $merged_data = [];

        // Merge sales data into the associative array
        foreach ($sales_summary as $item) {
            $item_name = $item["item_name"];
            if (!isset($merged_data[$item_name])) {
                $merged_data[$item_name] = ["item_name" => $item_name];
            }
            $merged_data[$item_name]["sales_quantity"] = $item["sales_quantity"];
            $merged_data[$item_name]["sales_total"] = $item["sales_total"];
        }

        // Merge purchase data into the associative array
        foreach ($purchase_summary as $item) {
            $item_name = $item["item_name"];
            if (!isset($merged_data[$item_name])) {
                $merged_data[$item_name] = ["item_name" => $item_name];
            }
            $merged_data[$item_name]["purchase_quantity"] = $item["purchase_quantity"];
            $merged_data[$item_name]["purchase_total"] = $item["purchase_total"];
        }



        // return $merged_data;
        // foreach($merged_data as $pro){
        //     return $pro['purchase_quantity'];
        // }
        return  view('pages.report.item_summary')
            ->with('date', null)
            ->with('merged_data', $merged_data);
    }


    public function inventoryReport()
    {
        $inventories= Inventory::all();
        return view('pages.report.inventory_report', [
            'inventories' => $inventories,
        ]);
    }
}
