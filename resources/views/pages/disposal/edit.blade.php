@extends('inc.frame')

@section('content')
@include('inc.message')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Edit Item </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                    <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                    <li class="breadcrumb-item"><a href="/items">Items</a></li>
                    <li class="breadcrumb-item active">Edit Item</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="modal-body p-5 pt-0">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="disposal-{{ $disposing->id }}" method="post" class="parsley-examples">
                        @csrf
                        <div class="row pb-3">
                            <div class="col-lg-6">
                                <label for="">Warehouse</label>
                                <select class="form-control" name="warehouse_id" required data-toggle="select2">
                                    <option value="{{ $disposing->warehouse_id }}">@if ($disposing->warehouse_id) {{ $disposing->warehouse->name }} @endif</option>

                                    @forelse ($warehouses as $warehouse )
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <label for="">Item</label>
                                <select class="form-control" name="item_id" required data-toggle="select2">
                                    <option value="{{ $disposing->item_id }}">@if ($disposing->item_id) {{ $disposing->item->name }} @endif</option>

                                    @forelse ($items as $item )
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col-lg-6">
                                <label class="form-label">Quantity</label>
                                <input  type="number"  name="quantity"  class="form-control" value="{{ $disposing->quantity }}"/>
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label">Unit Price</label>
                                <input  type="text" name="unit_price" class="form-control" value="{{ $disposing->unit_price }}"/>
                            </div>

                        </div>

                        <div>
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>
</div>
@endsection
