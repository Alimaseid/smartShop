@extends('inc.frame')

@section('content')
@include('inc.message')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">
                    <a href="/add-quotations" class="btn btn-primary" >
                        <i class="fa fa-plus-circle"> </i> Sales Quotation </a></h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item active">Sales Quotation</li>
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
                               @forelse ($quotations as $quotation)
                                 @php $no = $no + 1; @endphp

                                   <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $quotation->date }}</td>
                                    <td>{{ $quotation->customer->name }}</td>
                                    <td>{{ $quotation->invoice_no }}</td>

                                    <td>{{ $quotation->vat }} %</td>
                                    <td>{{ $quotation->discount }} %</td>
                                    <td>{{ $quotation->sub_total }}</td>
                                    <td>{{ $quotation->total }}</td>
                                    <td style="width: 10%">
                                        <a href="salesQuotation-{{ $quotation->id }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="salesQuotationDelete-{{ $quotation->id }}" onclick="return confirm('Are You Sure Remove This quotation ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
