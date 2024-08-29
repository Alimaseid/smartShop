<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisposalController;
use App\Http\Controllers\InventoryAdjustmentController;
use App\Http\Controllers\IssuingController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequisitionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesApprovedController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesQuotationController;
use App\Http\Controllers\ServiceSalesController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WarehouseController;
use App\Models\InventoryAdjustment;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\Sales;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    $totalSalesAmount = Sales::sum('total');
        $totalPurchaseAmount = Purchase::sum('total');
        $item = Item::all();

        return view('dashboard', compact('totalSalesAmount', 'totalPurchaseAmount', 'item'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', UserController::class);
    Route::get('edituser-{id}',[UserController::class, 'edit']);
    Route::resource('roles', RoleController::class);
    Route::get('editRole-{id}',[RoleController::class, 'edit']);


    Route::controller(WarehouseController::class)->group(function(){
        Route::get('warehouse','index');
        Route::post('warehouse','store');
        Route::post('store-{warehouse}','update');
        Route::get('store-{warehouse}','destroy');

        //shops

        Route::get('shops','shops');
        Route::post('shop','storeShop');
    });


    Route::controller(ItemController::class)->group(function(){
        Route::get('items','index');
        Route::get('add-item','add');
        Route::get('editItem-{id}','edit');
        Route::post('item','store');
        Route::post('itemEdit-{item}','update');
        Route::get('itemDelete-{item}','destroy');
        Route::post('category','category');
        Route::get('deleteCategory-{id}','deleteCategory');
    });

    Route::controller(RequisitionController::class)->group(function(){
        Route::get('requisition','index');
        Route::post('requisition','store');
        Route::post('requisition-{requisition}','update');
    });

    Route::controller(VendorController::class)->group(function(){
        Route::get('vendor','index');
        Route::post('vendor','store');
        Route::post('vendor-{vendor}','update');
        Route::get('vendorDelete-{vendor}','destroy');
        Route::get('vendor_ledger-{vendor}','ledger');
        Route::post('vendorPay-{vendor}','payment');
        Route::post('editPay-{payment}','editPayment');
    });

    Route::controller(PurchaseController::class)->group(function(){
        Route::get('purchase','index');
        Route::get('add-purchase','create');
        Route::post('purchase','store');
        Route::get('purchase-{purchase}','edit');
        Route::post('purchase-{purchase}','update');
        Route::get('purchaseDelete-{purchase}','destroy');

    });

    Route::controller(CustomerController::class)->group(function(){
        Route::get('customer','index');
        Route::post('customer','store');
        Route::post('customer/{customer}','update');
        Route::get('customerDelete-{customer}','destroy');
        Route::post('customerPay-{cust}','customerPay');
        Route::get('customer_ledger-{id}','ledger');
        Route::get('customer-statement-{customer}','statment');
        Route::post('getCustomerStatementByDate-{customer}','getStatmentByDate');
        Route::post('editCustomerPay-{pay}','editCustomerPay');
    });

    Route::controller(SalesController::class)->group(function(){
        Route::get('product-sales','index');
        Route::get('add-sales','create');
        Route::post('product-sales','store');
        Route::get('productSales-{sales}','edit');
        Route::post('productSales-{sales}','update');
    });

    Route::controller(ServiceSalesController::class)->group(function(){
        Route::get('service-sales','index');
        Route::get('add-service-sales','create');
        Route::post('service-sales','store');
        Route::get('productSales-{sales}','edit');
        Route::post('productSales-{sales}','update');
        Route::get('productSalesDelete-{id}','destroy');
    });

    Route::controller(SalesQuotationController::class)->group(function(){
        Route::get('sales-quotation','index');
        Route::get('add-quotations','create');
        Route::post('sales-quotation','store');
        Route::get('salesQuotation-{salesQuotation}','edit');
        Route::post('salesQuotation-{salesQuotation}','update');
        Route::get('salesQuotationDelete-{salesQuotation}','destroy');

    });

    Route::controller(TransferController::class)->group(function(){
        Route::get('transefer-item','items');
        Route::get('transfer-{id}','editItemTransfer');
        Route::post('item-transfer','store');
        Route::get('new-item-transfer','newItemTransfer');
        Route::post('editTransfer-{id}','storeItemTransfer');
        Route::get('transeferDelete-{id}','destroy');

    });

    Route::controller(ReportController::class)->group(function(){
       Route::get('sales-summary','salesSummary');
       Route::post('getSalesSummaryByDate','getSalesSummaryByDate');
       Route::get('purchaseSummary','purchaseSummary');
       Route::post('getPurchaseSummaryByDate','getPurchaseSummaryByDate');
       Route::get('itemSummary','itemSummary');
       Route::get('inventory-report','inventoryReport');
    });


    Route::controller(IssuingController::class)->group(function(){
        Route::get('issuings','index');
        Route::get('new-issuing','create');
        Route::post('issuing','store');
        Route::get('issue-{issuing}','edit');
        Route::post('issue-{issuing}','update');
        Route::get('issueRemove-{id}','destroy');
    });


    Route::controller(DisposalController::class)->group(function(){
        Route::get('disposing','index');
        Route::get('new-disposing','create');
        Route::post('disposing','store');
        Route::get('disposal-{id}','edit');
        Route::post('disposal-{disposing}','update');
        Route::get('disposalDelete-{disposing}','destroy');
    });

    Route::controller(InventoryAdjustmentController::class)->group(function(){
        Route::get('inventoryAdjustment','index');
        Route::get('new-adjustment','create');
        Route::post('inventoryAdjustment','store');
        Route::get('openingBalance-{id}','setOpeningBalance');
        Route::post('createOpeningBalance-{id}','openingBalance');
        Route::get('adjustmentEdit-{id}','edit');
        Route::post('inventoryAdjustment-{Id}','update');
        Route::get('adjustmentDelete-{id}','destroy');
    });

    Route::controller(SalesApprovedController::class)->group(function(){
        Route::get('salesApproved','index')->name('salesApproved');
        Route::get('approveSales-{id}','approve');

    });

});

require __DIR__.'/auth.php';
