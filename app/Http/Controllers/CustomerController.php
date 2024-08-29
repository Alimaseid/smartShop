<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CustomerLedger;
use App\Models\CustomerPayment;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:customer-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:customer-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $customers = Customer::orderBy('id','desc')->where('isTrash',false)->get();
        return view('pages.customer.customers')
        ->with('customers',$customers);
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
    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->all());
        $customer->total_balance = $request->opening_balance;
        $customer->save();

        return back()->with('success','Successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function statment(Customer $customer)
    {
        $ledgers = CustomerLedger::orderBy('id','desc')->where('customer_id', $customer->id)
        ->with('sales.details.item:id,name')
        ->with('payment')
        ->get();

        $in = collect($ledgers)->sum('in');
        $out = collect($ledgers)->sum('out');
        // return ;
        return view('pages.customer.statment')
        ->with('in', $in)
        ->with('out', $out)
        ->with('ledgers', $ledgers)
        ->with('date', null)
        ->with('customer', $customer);
    }

    public function getStatmentByDate(Request $request,$customer){
        $request->validate(['daterange' => 'required']);
        $customer = Customer::find($customer);

        $start_date =  Carbon::parse(Str::before($request->daterange, '-'));
        $end_date =  Carbon::parse(Str::after($request->daterange, '-'));


        $ledgers = CustomerLedger::orderBy('id','desc')
         ->where('customer_id', $customer->id)
        ->whereBetween('created_at',[$start_date,$end_date->addDay()])
        ->with('sales.details.item:id,name')
        ->with('payment')
        ->get();

        // return $ledgers;

        $in = collect($ledgers)->sum('in');
        $out = collect($ledgers)->sum('out');
        // return ;
        return view('pages.customer.statment')
        ->with('in', $in)
        ->with('out', $out)
        ->with('ledgers', $ledgers)
        ->with('date', $request->daterange)
        ->with('customer', $customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->city = $request->city;
        $customer->woreda = $request->woreda;
        $customer->kebele = $request->kebele;
        $customer->save();

        return back()->with('success', $customer->name.'  Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->isTrash = true;
        $customer->save();
        return back()->with('success', $customer->name.'  Removed Successfully');

    }


    public function ledger($id){
        $customer = Customer::find($id);
        $ledgers = CustomerLedger::orderBy('id','desc')->where('customer_id', $id)
        ->with('sales.details.item:id,name')
        ->with('payment')

        ->get();
        // return $ledgers;
        return view('pages.customer.customer_ledger')
        ->with('customer', $customer)
        ->with('ledgers', $ledgers);
    }




    public function customerPay(Request $request,$cust){
        $request->validate([
            'amount' => 'required|numeric',
            'payment_type' => 'required',
            'date' => 'required|date',
            'payment_no' => 'required|unique:customer_payments,payment_no,'
          ]);

          $payment = CustomerPayment::create([
             'customer_id' => $cust,
             'amount' => $request->amount,
             'payment_type' => $request->payment_type,
             'check_or_transfer_id' => $request->check_or_transfer_id,
             'remarks' => $request->remarks,
             'created_at'  => $request->date,
             'payment_no'=>$request->payment_no
          ]);


          $customer = Customer::find($cust);
          $customer->total_balance = $customer->total_balance - $request->amount;
          $customer->save();

          CustomerLedger::create([
             'customer_id' => $cust,
             'in' => $request->amount,
             'customer_payment_id' => $payment->id,
             'current_balance' => $customer->total_balance,
             'reason' => $request->remark,
          ]);

          return back()->with('success','successfuly Paid');

    }

    public function editCustomerPay(Request $request, $pay){
        $request->validate([
            'amount' => 'required|numeric',
            'payment_type' => 'required',
            'date' => 'required|date',
          ]);


          $payment = CustomerPayment::where('id',$pay)->first();
          $delta = $payment->amount - $request->amount;

        //   return $delta;

          $payment->amount = $request->amount;
          $payment->payment_type = $request->payment_type;
          $payment->check_or_transfer_id = $request->check_or_transfer_id;
          $payment->remarks = $request->remarks;
          $payment->created_at  = $request->date;
          $payment->save();

          $customer = Customer::find($payment->customer_id);
          $customer->total_balance = $customer->total_balance + $delta;
          $customer->save();

          $ledger = CustomerLedger::where('customer_payment_id',$pay)->first();
          if($ledger){
            $ledger->in = $request->amount;
            $ledger->current_balance = $ledger->current_balance + $delta;
            $ledger->reason = $request->remarks;
            $ledger->save();

            $affecte_ledger = CustomerLedger::where('id','>',$ledger->id)
            ->where('customer_id' ,$customer->id)
            ->get();
            if($affecte_ledger){
              foreach($affecte_ledger as $affeted){
                  $affeted->current_balance = $affeted->current_balance + $delta;
                  $affeted->save();
              }
            }
          }


          return back()->with('success','successfuly Updated');
        }

}
