<?php

namespace App\Http\Controllers;

use App\Models\warehouse;
use App\Http\Requests\StorewarehouseRequest;
use App\Http\Requests\UpdatewarehouseRequest;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = warehouse::where('isShop', false)->get();
        return view('pages.warehouse.warehouses')->with('warehouses', $warehouses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorewarehouseRequest $request)
    {

        $request->validated($request->all());

        $data = warehouse::create($request->all());
        $data->location_type = $request->location_type;
        $data->save();
        return back()->with('success', 'Location Create Successful');
    }

    /**
     * Display the specified resource.
     */
    public function show(warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatewarehouseRequest $request, warehouse $warehouse)
    {
        $request->validated($request->all());
        $warehouse->update($request->all());
        return back()->with('success', 'Location updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(warehouse $warehouse)
    {
        // warehouse::destroy($warehouse);
        // $warehouse->isTrash = true;
        // $warehouse->save();
        $warehouse->delete();
        return back()->with('success', 'Successfully destroyed');
    }



    //shop

    public function shops()
    {
        $shops = warehouse::where('isTrash', false)->where('isShop', true)->get();
        return view('pages.warehouse.shops')->with('shops', $shops);
    }

    public function storeShop(StorewarehouseRequest $request)
    {
        $request->validated($request->all());
        $shop = warehouse::create($request->all());
        $shop->isShop = true;
        $shop->save();
        return back()->with('success', 'Warehouse Create Successful');
    }
}
