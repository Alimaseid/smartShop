@extends('inc.frame')

@section('content')
    @include('inc.message')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">DashBoard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card " style="background-color: #eceef0">
                <div class="card-body" style="background: linear-gradient(to right,  #2ac4fd, #6e5798); border-radius:0%;">
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="text-end">

                            <h4 class=" mb-0" style="color: white"> Items</h4>
                            <h3 class="text-center">
                                <span data-plugin="counterup" style="color: white">{{$item->count()}}</span>
                            </h3>

                        </div>

                        <div class="">
                            <i class="fas fa-barcode"
                                style="font-size: 50px; width: 50px; height: 50px; color:#ffffff"></i>

                        </div>

                    </div>
                </div>

            </div>
        </div><!-- end col -->

        <div class="col-xl-4 col-md-6">
            <div class="card " style="background-color: #eceef0">
                <div class="card-body" style="background: linear-gradient(to right, #2ecc71, #2dc8c5); border-radius:0%;">
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="text-end">

                            <h4 class=" mb-0" style="color: white">Total Sales Amount</h4>

                            <h3 class="text-center">
                                <span data-plugin="counterup" style="color: white"> {{$totalSalesAmount}}</span>
                            </h3>

                        </div>

                        <div class="">
                            <i class="fas fa-shopping-cart"
                                style="font-size: 50px; width: 50px; height: 50px; color:#ffffff"></i>

                        </div>

                    </div>
                </div>

            </div>
        </div><!-- end col -->

        <div class="col-xl-4 col-md-6">
            <div class="card " style="background-color: #eceef0">
                <div class="card-body" style="background: linear-gradient(to right, #9b59b6, #e91e63); border-radius:0%;">
                    <div class="d-flex justify-content-between align-items-center">

                        <div class="text-end">

                            <h4 class=" mb-0" style="color: white"> Total Purchase Amount</h4>
                            <h3 class="text-center">
                                <span data-plugin="counterup" style="color: white"> {{$totalPurchaseAmount}}</span>
                            </h3>
                        </div>
                        <div class="">
                            <i class="fas fa-ambulance"
                                style="font-size: 50px; width: 50px; height: 50px; color:#ffffff"></i>
                        </div>

                    </div>
                </div>

            </div>
        </div><!-- end col -->



    </div>
@endsection
