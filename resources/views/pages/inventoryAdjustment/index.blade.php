@extends('inc.frame')

@section('content')
    @include('inc.message')
    {{-- <title>ERP-Inventory Items</title> --}}

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">
                    <a class="btn btn-primary btn-sm" href="/new-adjustment">
                        <i class="fa fa-plus-circle"> ADD New Adjustment </i></a>
                </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item active">Adjustment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" style="font-size:12px"
                        class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ItemName</th>
                                <th>Warehouse</th>
                                <th>Quantity</th>
                                <th>Adjustment Date</th>
                                <th>Remark </th>
                                <th>_______</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0; @endphp
                            @forelse ($adjustments as $adjustment)
                                @if ($adjustment->adjustment_type == 'CORRECTION')
                                    @php $no = $no + 1; @endphp

                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $adjustment->item->name }}</td>
                                        <td>{{ $adjustment->warehouse->name }}</td>
                                        <td>{{ $adjustment->quantity }}</td>
                                        <td>
                                            @php
                                                $adjustmentDate = \Carbon\Carbon::parse(
                                                    $adjustment->adjustment_date,
                                                )->format('m-d-y');
                                            @endphp
                                            {{ $adjustmentDate }}
                                        </td>
                                        <td>{{ $adjustment->remarks }}</td>
                                        <td>
                                            <a href="adjustmentEdit-{{ $adjustment->id }}" class="btn btn-primary"><i
                                                    class="fa fa-edit"></i></a>
                                            <a href="adjustmentDelete-{{ $adjustment->id }}" class="btn btn-danger"><i
                                                    class="fa fa-trash"></i></a>
                                        </td>


                                    </tr>

                                @endif
                                @empty
                            @endforelse

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection
