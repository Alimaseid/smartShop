<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Models\VendorLedger;
use App\Models\VendorPayment;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::orderBy('id','desc')->where('isTrash',false)->get();

        return view('pages.vendor.vendors')
        ->with('vendors',$vendors);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendorRequest $request)
    {
        $vendor = Vendor::create($request->all());
        $vendor->total_balance = $request->opening_balance;
        $vendor->save();
        return back()->with('success', $request->name.' created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $vendor->name = $request->name;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->company_name = $request->company_name;
        $vendor->city = $request->city;
        $vendor->woreda = $request->woreda;
        $vendor->kebele = $request->kebele;
        $vendor->save();
        return back()->with('success','Successfully Updated.');
    }

    public function ledger($id){
        $vendor = Vendor::find($id);
        $ledgers = VendorLedger::orderBy('id','desc')->where('vendor_id', $id)
        ->with('purchase.details.item:id,name')
        ->with('payment')

        ->get();
        // return $ledgers;
        return view('pages.vendor.vendor_ledger')
        ->with('vendor', $vendor)
        ->with('ledgers', $ledgers);
    }


    public function payment(Request $request,$vend){
         $request->validate([
           'amount' => 'required|numeric',
           'payment_type' => 'required',
           'date' => 'required|date',
         ]);

         $payment = VendorPayment::create([
            'vendor_id' => $vend,
            'amount' => $request->amount,
            'payment_type' => $request->payment_type,
            'check_or_transfer_id' => $request->check_or_transfer_id,
            'remarks' => $request->remarks,
            'created_at'  => $request->date
         ]);

         $vendor = Vendor::find($vend);
         $vendor->total_balance = $vendor->total_balance - $request->amount;
         $vendor->save();

         VendorLedger::create([
            'vendor_id' => $vend,
            'out' => $request->amount,
            'vendor_payment_id' => $payment->id,
            'current_balance' => $vendor->total_balance,
            'reason' => $request->remark,
         ]);

         return back()->with('success','successfuly Paid');
    }


    public function editPayment(Request $request, $pay){
        $request->validate([
            'amount' => 'required|numeric',
            'payment_type' => 'required',
            'date' => 'required|date',
          ]);


          $payment = VendorPayment::where('id',$pay)->first();
          $delta = $payment->amount - $request->amount;

        //   return $delta;

          $payment->amount = $request->amount;
          $payment->payment_type = $request->payment_type;
          $payment->check_or_transfer_id = $request->check_or_transfer_id;
          $payment->remarks = $request->remarks;
          $payment->created_at  = $request->date;
          $payment->save();

          $vendor = Vendor::find($payment->vendor_id);
          $vendor->total_balance = $vendor->total_balance + $delta;
          $vendor->save();

          $ledger = VendorLedger::where('vendor_payment_id',$pay)->first();
          if($ledger){
            $ledger->out = $request->amount;
            $ledger->current_balance = $ledger->current_balance + $delta;
            $ledger->reason = $request->remarks;
            $ledger->save();

            $affecte_ledger = VendorLedger::where('id','>',$ledger->id)
            ->where('vendor_id' ,$vendor->id)
            ->get();
            if($affecte_ledger){
              foreach($affecte_ledger as $affeted){
                  $affeted->current_balance = $affeted->current_balance + $delta;
                  $affeted->save();
              }
            }
          }






          return back()->with('success','successfuly Paid');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->isTrash = true;
        $vendor->save();
        return back()->with('success','Successfully');
    }
}
