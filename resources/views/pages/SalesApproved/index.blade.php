@extends('inc.frame')

@section('content')
    @include('inc.message')
    {{-- <title>ERP-Inventory Items</title> --}}

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">
                Sales
                </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item active">Items</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <form method="GET" action="{{ route('salesApproved') }}">
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="">from</label>
                <input type="date" name="start_date" class="form-control" placeholder="Start Date">
            </div>
            <div class="col-md-3">
                <label for="">to</label>
                <input type="date" name="end_date" class="form-control" placeholder="End Date">
            </div>
            <div class="col-md-3 mt-3">
                <input type="text" name="customer_name" class="form-control" placeholder="Customer Name">
            </div>
            <div class="col-md-3 mt-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>


    <div class="row " style="max-height: 50%">
        <div class="col-2">
            <h4> Pending sales</h4>
        </div>
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" style="font-size:12px"
                        class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Invoice Number</th>
                                <th>Sales Type</th>
                                <th>Total Amount</th>
                                <th>Detail</th>
                                <th>Status</th>
                                <th>_______</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0; @endphp
                            @foreach ($sales as $sale)
                                @if ($sale->status == 'Pending' )
                                    @php $no = $no + 1; @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td> {{ $sale->date }}</td>
                                        <td>{{ $sale->customer->name }}</td>
                                        <td>{{ $sale->invoice_no }}</td>
                                        <td>{{ $sale->sales_type }}</td>
                                        <td>{{ $sale->total }}</td>
                                        <td> <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#viewItem{{ $sale->id }}">
                                                View </button></td>

                                        <!-- Modal -->
                                        <div class="modal fade mt-5" id="viewItem{{ $sale->id }}" tabindex="3"
                                            role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title" id="viewItemLabel">Items</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="">
                                                            @csrf

                                                            <div class="row " style="margin-left: 10px">
                                                                <div class="col-sm-3 col-3">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">Item</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-3">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">quantity</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-3">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">Unit Price</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-3">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputCity1">Total</label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <hr>
                                                            @foreach ($salesDetails as $salesDetail)
                                                                @if ($salesDetail->sales_id == $sale->id)
                                                                    <div class="row">
                                                                        <div class="col-sm-3 col-3">
                                                                            <div class="form-group">

                                                                                <input type="text" class="form-control"
                                                                                    id="category_name" name="item_id"
                                                                                    value=" {{ $salesDetail->item->name }}"
                                                                                    placeholder="Category Name"style="border-block-color: white;border-color:white">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-3 col-3">
                                                                            <div class="form-group">

                                                                                <input type="text" class="form-control"
                                                                                    id="quantity" name="quantity[]"
                                                                                    value="  {{ $salesDetail->quantity }}"
                                                                                    oninput="calculateTotal()"
                                                                                    placeholder="Category Name"
                                                                                    style="border-block-color: white;border-color:white">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-3 col-3">
                                                                            <div class="form-group">

                                                                                <input type="text" class="form-control"
                                                                                    id="quantity" name="quantity[]"
                                                                                    value="  {{ $salesDetail->unit_price }}"
                                                                                    style="border-block-color: white;border-color:white">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-3 col-3">
                                                                            <div class="form-group">

                                                                                <input type="text" class="form-control"
                                                                                    id="quantity" name="quantity[]"
                                                                                    value="  {{ $salesDetail->total }}"
                                                                                    style="border-block-color: white;border-color:white">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                @endif
                                                            @endforeach

                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <td class="text-center">
                                            <div class="dropdown">
                                                @if ($sale->status == 'Pending')
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                                        id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                        {{ $sale->status }}
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdown">
                                                        <li><a href="approveSales-{{ $sale->id }}"
                                                                class="dropdown-item">Approved</a></li>
                                                    </ul>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <div class="row " style="max-height: 50%">
        <div class="col-2">
            <h4> Approved sales</h4>
        </div>
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" style="font-size:12px"
                        class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Invoice Number</th>
                                <th>Sales Type</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0; @endphp
                            @foreach ($approvedSales as $sale)
                                @if ($sale->status == 'Approved')
                                    @php $no = $no + 1; @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td> {{ $sale->date }}</td>
                                        <td>{{ $sale->customer->name }}</td>
                                        <td>{{ $sale->invoice_no }}</td>
                                        <td>{{ $sale->sales_type }}</td>
                                        <td>{{ $sale->total }}</td>
                                        <td style="color:rgb(2, 133, 2)">{{ $sale->status }}</td>

                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <script src="../../assets/js/app.min.js"></script>
@endsection
