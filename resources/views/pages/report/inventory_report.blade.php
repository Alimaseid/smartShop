@extends('inc.frame')


@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"> Inventory Report</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                    <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                    <li class="breadcrumb-item active">Inventory Report</li>
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
                            <th> Equipment ID</th>
                            <th> Equipment Name</th>
                            <th>Category</th>
                            <th>Model</th>
                            <th>Serial Number</th>
                            <th>Location </th>
                            <th>Total Quantity </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->item->item_number}}</td>
                            <td>{{ $inventory->item->name}}</td>
                            <td>{{ $inventory->item->category}}</td>
                            <td>{{ $inventory->item->nodel}}</td>
                            <td>{{ $inventory->item->serial_number}}</td>
                            <td>{{$inventory->warehouse->name}}</td>
                            <td>{{ $inventory->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

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
