<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Customer;
use App\Models\SalesQuotation;
use App\Http\Requests\StoreSalesQuotationRequest;
use App\Http\Requests\UpdateSalesQuotationRequest;
use App\Models\QuatationDetail;

class SalesQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotations = SalesQuotation::orderBy('id', 'DESC')->get();
        return view('pages.quotation.quotations')->with('quotations', $quotations);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::orderBy('id','desc')
        ->where('isTrash',false)
        ->get();
        $customers = Customer::where('isTrash',false)->get();

        return view('pages.quotation.add')
        ->with('items',$items)
        ->with('customers',$customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalesQuotationRequest $request)
    {

      $quotation = SalesQuotation::create([
        'customer_id' =>  $request->customer_id,
        'date' =>  $request->date,
        'expiration_date' =>  $request->expiration_date,
        'invoice_no' =>  $request->invoice_no,
        'payment_term' =>  $request->payment_term,
        'due_date' =>  $request->due_date,
        'sub_total' =>  0,
        'discount' =>  $request->discount,
        'vat' =>  $request->vat,
        'total' => 0,
      ]);

      $sub_total = 0;

       foreach($request->product_list as $product){
            QuatationDetail::create([
                'sales_quotation_id' =>$quotation->id,
                'item_id' =>$product['item_id'],
                'quantity' => $product['quantity'],
                'unit' => $product['unit'],
                'unit_price' => $product['price'],
                'amount' => $product['price'] *  $product['quantity'],
            ]);

            $sub_total = $sub_total + $product['quantity'] * $product['price'];
       }

       $vat = $sub_total * $request->vat /100;
       $discount = $sub_total * $request->discount /100;
       $net = $sub_total - $discount;
       $total = $net + $vat;
       $quotation->sub_total = $net;
       $quotation->total = $total;
       $quotation->save();



      return redirect('/sales-quotation')->with('success',' Sales Quotation Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SalesQuotation $salesQuotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesQuotation $salesQuotation)
    {
        $quotation =  SalesQuotation::where('id',$salesQuotation->id)
        ->with('details.item:id,name,unit')
        ->with('customer:id,name')
        ->orderBy('id','desc')
        ->first();
        // return $purchase;
        $items = Item::where('isTrash',false)->get();
        $customers = Customer::where('isTrash',false)->get();
        return view('pages.quotation.edit')
        ->with('quotation',$quotation)
        ->with('customers',$customers)
        ->with('items',$items);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalesQuotationRequest $request, SalesQuotation $salesQuotation)
    {
          QuatationDetail::where('sales_quotation_id',$salesQuotation->id)->delete();

          $sub_total = 0;

           foreach($request->product_list as $product){
                QuatationDetail::create([
                    'sales_quotation_id' =>$salesQuotation->id,
                    'item_id' =>$product['item_id'],
                    'quantity' => $product['quantity'],
                    'unit' => $product['unit'],
                    'unit_price' => $product['price'],
                    'amount' => $product['price'] *  $product['quantity'],
                ]);

                $sub_total = $sub_total + $product['quantity'] * $product['price'];
           }

           $vat = $sub_total * $request->vat /100;
           $discount = $sub_total * $request->discount /100;
           $net = $sub_total - $discount;
           $total = $net + $vat;

           SalesQuotation::where('id',$salesQuotation->id)->update([
            'customer_id' =>  $request->customer_id,
            'date' =>  $request->date,
            'expiration_date' =>  $request->expiration_date,
            'invoice_no' =>  $request->invoice_no,
            'payment_term' =>  $request->payment_term,
            'due_date' =>  $request->due_date,
            'sub_total' =>  $net,
            'discount' =>  $request->discount,
            'vat' =>  $request->vat,
            'total' => $total,
          ]);


          return redirect('/sales-quotation')->with('success',' Sales Quotation Saved Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesQuotation $salesQuotation)
    {
        QuatationDetail::where('sales_quotation_id',$salesQuotation->id)->delete();
        $salesQuotation->delete();
        return redirect('/sales-quotation')->with('success', 'SalesQuotation deleted successfully');
    }
}
