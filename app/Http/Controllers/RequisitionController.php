<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use App\Http\Requests\StoreRequisitionRequest;
use App\Http\Requests\UpdateRequisitionRequest;
use App\Models\Item;
use App\Models\RequisitionDetail;
use Illuminate\Support\Facades\Auth;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requisitions = Requisition::orderBy('id','DESC')
        ->where('isTrash',false)
        ->with('requisitionDetails.item:id,name')
        ->paginate(10);


        $items = Item::where('isTrash',false)->get();

        return view('pages.requisition.requisition')
        ->with('items', $items)
        ->with('requisitions', $requisitions);
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
    public function store(StoreRequisitionRequest $request)
    {

        $rqst = Requisition::create([
            // 'requested_by' => Auth::user()->id,
            'requested_by' => 1,
            'requisition_no' =>  $request->requisition_no,
            'requisition_date'  => $request->requisition_date,
            'description_title' => $request->description_title,
            'description' => $request->description,
        ]);

        foreach($request->list as $item){
            RequisitionDetail::create([
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
                'unit' => $item['unit'],
                'remarks' => $item['remarks'],
                'requisition_id' => $rqst->id
            ]);
        }

        return back()->with('success','Sent Request Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Requisition $requisition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requisition $requisition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequisitionRequest $request, Requisition $requisition)
    {
        Requisition::where('id',$requisition->id)->update([
            // 'requested_by' => Auth::user()->id,
            'requested_by' => 1,
            'requisition_no' =>  $request->requisition_no,
            'requisition_date'  => $request->requisition_date,
            'description_title' => $request->description_title,
            'description' => $request->description,
        ]);
        RequisitionDetail::where('requisition_id',$requisition->id)->delete();


        foreach($request->list as $item){
            RequisitionDetail::create([
                'item_id' => $item['item_id'],
                'quantity' => $item['quantity'],
                'unit' => $item['unit'],
                'remarks' => $item['remarks'],
                'requisition_id' => $requisition->id
            ]);
        }

        return back()->with('success','Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requisition $requisition)
    {
        //
    }
}
