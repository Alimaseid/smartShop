@extends('inc.frame')

@section('content')
    @include('inc.message')
    {{-- <title>ERP-Inventory Items</title> --}}

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">
                    <a class="btn btn-primary btn-sm" href="/new-disposing">
                        <i class="fa fa-plus-circle"> ADD New Disposing </i></a>
                </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item active">Disposal</li>
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
                                <th>Category</th>
                                <th>Warehouse</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>_______</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0; @endphp
                            @forelse ($disposals as $disposal)
                              @php $no = $no + 1; @endphp

                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $disposal->item->name }}</td>
                                    <td>{{ $disposal->item->category}}</td>
                                    <td>{{ $disposal->warehouse->name }}</td>
                                    <td>{{ $disposal->quantity}}</td>
                                    <td>{{ $disposal->total_price}}</td>
                                    <td>
                                        <a href="disposal-{{ $disposal->id }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="disposalDelete-{{ $disposal->id }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
