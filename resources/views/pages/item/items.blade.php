
@extends('inc.frame')

@section('content')
@include('inc.message')
{{-- <title>ERP-Inventory Items</title> --}}

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">
            <a class="btn btn-primary btn-sm" href="/add-item">
                <i class="fa fa-plus-circle"> ADD New Item </i></a></h4>
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


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" style="font-size:12px" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ItemName</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Cost</th>
                            <th>Reorder</th>
                            <th>ProductCode</th>
                            <th>manufacturer</th>
                            <th>Supplier</th>
                            <th>_______</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 0; @endphp
                           @forelse ($items as $item)
                             @php $no = $no + 1; @endphp

                               <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->cost_price }}</td>
                                <td>{{ $item->reorder_level }}</td>
                                <td>{{ $item->model }}</td>
                                <td>{{ $item->manufacturer }}</td>
                                <td>{{ $item->supplier_name }}</td>
                                <td style="width: 10%">
                                    <a href="openingBalance-{{ $item->id }}"  class="btn btn-info btn-sm">Set Op.Bal</i></a>
                                    <a href="editItem-{{ $item->id }}"  class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    {{-- <a onclick="editItem({{ $item }})" data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> --}}
                                    <a href="itemDelete-{{ $item->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
