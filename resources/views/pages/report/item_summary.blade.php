@extends('inc.frame')

@section('content')
@include('inc.message')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title"> Item Summary Report</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item active">Item Summary</li>
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
                                <th>ItemName</th>
                                <th>PurchaseQyt</th>
                                <th>PurchaseTotal</th>
                                <th>SalesQuantity</th>
                                <th>SaleesTotal</th>
                                <th>RemainQuantity</th>
                                {{-- <th>Balance</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0; @endphp
                               @forelse ($merged_data as $key=>$summary)
                                 @php $no = $no + 1; @endphp

                                 <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{$summary['item_name'] }}</td>
                                    <td>{{ number_format($summary['purchase_quantity'],2) }}</td>
                                    <td>{{ $summary['purchase_total'] }}</td>
                                    @if (array_key_exists('sales_quantity',$summary))
                                        <td>{{  number_format($summary['sales_quantity'],2) }}</td>
                                        <td>{{  number_format($summary['sales_total'],2) }}</td>
                                        <td>{{  number_format($summary['purchase_quantity'] - $summary['sales_quantity'],2) }}</td>
                                    @else
                                    <td>{{  number_format(0,2) }}</td>
                                    <td>{{  number_format(0,2) }}</td>
                                    <td>{{  number_format($summary['purchase_quantity'],2) }}</td>
                                    @endif


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



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="assets/js/vendor.min.js"></script>

<!-- Plugins js-->
<script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/moment/min/moment.min.js"></script>
<script src="assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Init js-->
<script src="assets/js/pages/form-pickers.init.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>
@endsection
