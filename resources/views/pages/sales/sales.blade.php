@extends('inc.frame')

@section('content')
@include('inc.message')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">
                    <a href="/add-sales" class="btn btn-primary" >
                        <i class="fa fa-plus-circle"> </i> Product Sales </a></h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item active">Product Sales</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" style="font-size:12px" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Invoice#</th>
                                <th>Tax</th>
                                <th>Discount</th>
                                <th>SubTotal</th>
                                <th>Total</th>
                                <th>_______</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0; @endphp
                               @forelse ($sales as $sale)
                                 @php $no = $no + 1; @endphp

                                   <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $sale->date }}</td>
                                    <td>{{ $sale->customer->name }}</td>
                                    <td>{{ $sale->invoice_no }}</td>

                                    <td>{{ $sale->vat }} %</td>
                                    <td>{{ $sale->discount }} %</td>
                                    <td>{{ $sale->sub_total }}</td>
                                    <td>{{ $sale->total }}</td>
                                    <td style="width: 10%">
                                        <a href="productSales-{{ $sale->id }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="ProductSalesDelete-{{ $sale->id }}" onclick="return confirm('Are You Sure Remove This sale ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                   </tr>
                               @empty

                               @endforelse
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

</div> <!-- container-fluid -->


@endsection
