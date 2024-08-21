@extends('inc.frame')

@section('content')
@include('inc.message')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="row">
                    <label for="">Get Summary By Date Range</label>
                    <form action="getSalesSummaryByDate" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <input id="btn" class="form-control input-daterange-datepicker" type="text" name="daterange"/>
                            </div>
                            <div class="col-lg-2">
                                <button id="btn" class="btn btn-dark">Go</button>
                            </div>
                            <div class="col-lg-4">
                              <label for="">Summary Range</label>
                               <p for="">@if($date) {{ $date }} @else Until  - {{ now()->format('M-d,Y') }} @endif</p>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item active">Sales Summary</li>
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
                                <th>Customer</th>
                                <th>SurviceAmount</th>
                                <th>Tax</th>
                                <th>TotalAmount</th>
                                <th>PaidAmount</th>
                                <th>AmountToCollectt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0; @endphp
                               @forelse ($summary as $summary)
                                 @php $no = $no + 1; @endphp

                                   <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{$summary['customer'] }}</td>
                                    <td>{{  number_format($summary['service_amount'],2) }}</td>
                                    <td>{{  number_format($summary['tax'],2) }}</td>
                                    <td>{{  number_format($summary['total'],2) }}</td>
                                    <td>{{  number_format($summary['paid_amount'],2) }}</td>
                                    <td>{{  number_format($summary['amount_to_collect'],2) }}</td>

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
