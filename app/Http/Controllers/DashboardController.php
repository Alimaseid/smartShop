<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\Sales;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $totalSalesAmount = Sales::sum('total');
        $totalPurchaseAmount = Purchase::sum('total');
        $item = Item::all();

        return view('dashboard', compact('totalSalesAmount', 'totalPurchaseAmount', 'item'));
    }
}
