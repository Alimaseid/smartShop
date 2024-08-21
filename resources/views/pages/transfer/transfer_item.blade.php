@extends('inc.frame')

@section('content')

@include('inc.message')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">
            <a class="btn btn-primary btn-sm" href="/new-item-transfer">
                <i class="fa fa-plus-circle"> New Transfer </i></a></h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                    <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                    <li class="breadcrumb-item active">Item Transfer</li>
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
                            <th>TransferFrom</th>
                            <th>TransferFrom</th>
                            <th>TransferredBy</th>
                            <th>ReceivedBy</th>
                            <th>Reference#</th>
                            <th>_______</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 0; @endphp
                        @forelse ($transfers as $transfer)
                          @php $no = $no + 1; @endphp

                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $transfer->created_at->toDateString() }}</td>
                                <td>{{ $transfer->from->name }}</td>
                                <td>{{ $transfer->to->name }}</td>
                                <td>{{ $transfer->transferred_by}}</td>
                                <td>{{ $transfer->received_by}}</td>
                                <td>{{ $transfer->rf_number}}</td>
                                <td>
                                    <a href="transfer-{{ $transfer->id }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="transeferDelete-{{ $transfer->id }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
@endsection
