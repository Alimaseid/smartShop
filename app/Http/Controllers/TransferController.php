<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\warehouse;
use Illuminate\Http\Request;
use App\Http\Requests\TransferRequest;
use App\Models\ItemPerStore;
use App\Models\TransferItem;
use App\Models\TransferItemDetail;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function items(){
        $transfers = TransferItem::orderby('id','desc')
        ->with('details')
        ->with('to')
        ->with('from')
        ->get();
        return view('pages.transfer.transfer_item')->with('transfers', $transfers);
    }

    public function newItemTransfer(){
        $items = Item::orderBy('id','desc')->where('isTrash',false)->get();
        $locations = warehouse::all();
        return view('pages.transfer.new_transfer_item')
        ->with('locations',$locations)
        ->with('items',$items);
    }

    public function store(TransferRequest $request){
       $transfer =  TransferItem::create(
            [
            "created_at" => $request->date,
            "rf_number"=> $request->rf_number,
            "location_from"=> $request->location_from,
            "location_to"=>$request->location_to,
            "transferred_by" =>1,
            "received_by"=>$request->received_by,
            "remark"=>$request->remark,
            ]
        );

        foreach($request->product_list as $item){
            TransferItemDetail::create([
                'transfer_item_id' => $transfer->id,
                'item_id' => $item['item_id'],
                'item_name' => $item['item'],
                'quantity' => $item['quantity'],
            ]);

            $this->setItemStoreBalance( $request->location_from, $request->location_to, $item['item_id'], $item['quantity']);
        }
        return redirect('/transefer-item')->with('success','Transfer Successfully Registered');
    }


    public function editItemTransfer($id){
        $transfer = TransferItem::with('details')->with('from')->with('to')->find($id);
        $items = Item::orderBy('id','desc')->where('isTrash',false)->get();
        $locations = warehouse::where('isTrash',false)->get();
        return view('pages.transfer.edit_transfer_item')
        ->with('transfer',$transfer)
        ->with('locations',$locations)
        ->with('items',$items);

    }

    public function storeItemTransfer(Request $request,$id){
        $request->validate([
            "location_from"=>'required',
            "location_to"=>'required',
            "transferred_by"=>'required',
            "received_by"=>'required',
            'product_list'=>'required',
        ]);

        // return $request->product_list;
        $transfer = TransferItem::find($id);


        // remove old details
        $details = TransferItemDetail::where('transfer_item_id',$transfer->id)->get();
        foreach($details as $detail){
            // simply revert the transfer location setter in order to avoid redundacy
            $this->setItemStoreBalance($transfer->location_to,$transfer->location_from,$detail->item_id,$detail->quantity);
            $detail->delete();
        }

        $transfer->created_at =  $request->date;
        $transfer->location_from = $request->location_from;
        $transfer->location_to = $request->location_to;
        $transfer->transferred_by = 1;
        $transfer->received_by =$request->received_by;
        $transfer->remark =$request->remark;
        $transfer->save();

        // create a new details
        foreach($request->product_list as $detail){
            TransferItemDetail::create([
                'transfer_item_id' => $transfer->id,
                'item_id' => $detail['item_id'],
                'item_name' => $detail['item'],
                'quantity' => $detail['quantity'],
            ]);
            // simply revert the transfer location setter in order to avoid redundacy
            $this->setItemStoreBalance($transfer->location_from,$transfer->location_to,$detail['item_id'],$detail['quantity']);
        }



      return redirect('/transefer-item')->with('success', 'Updated');
    }

    // helper function

    public function setItemStoreBalance($from,$to,$item,$quantity){
        $subtract =  ItemPerStore::where('store_id',$from)->where('item_id',$item)->first();
        $add =  ItemPerStore::where('store_id',$to)->where('item_id',$item)->first();

        if($subtract){
            $subtract->quantity = $subtract->quantity - $quantity;
            $subtract->save();
        }else{
            ItemPerStore::create([
                'item_id'=>$item,
                'store_id'=>$from,
                'quantity'=> - $quantity,
            ]);
        }

        if($add){
            $add->quantity = $add->quantity +  $quantity;
            $add->save();
        }else{
            ItemPerStore::create([
                'item_id'=>$item,
                'store_id'=>$to,
                'quantity'=>$quantity,
            ]);
        }
    }

    public function destroy($id)
    {

        TransferItemDetail::where('transfer_item_id', $id)->delete();
        TransferItem::find($id)->delete();
        return  redirect('/transefer-item')->with('success', 'Item Transfer Successfuly Removed.');
    }
}
