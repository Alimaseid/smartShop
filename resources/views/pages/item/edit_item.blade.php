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
                    <form action="itemEdit-{{ $item->id }}" method="post" class="parsley-examples">
                        @csrf
                        <div class="row pb-2">
                            <div class="col-lg-4">
                                <label class="form-label">Item Number</label>
                                <input  type="text" name="item_number" class="form-control" value="{{ $item->item_number }}"/>
                            </div>
                            <div class="col-lg-8">
                                <label class="form-label">Description *</label>
                                <input  type="text" name="name" class="form-control" required value="{{ $item->name }}"/>
                            </div>
                        </div>

                        <div class="row pb-2">
                            <div class="col-lg-4">
                                <label class="form-label">Item Class </label>
                                <select name="item_class" class="form-control" id="" required>
                                    <option value="{{ $item->item_class }}">{{ $item->item_class }}</option>
                                    <option value="Stok Item">Stok Item</option>
                                    <option value="Non-Stock Item">Non-Stock Item</option>
                                    <option value="Service">Service</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">Category</label>
                                <select name="category"  required class="form-control" id="">
                                    <option value="{{ $item->category }}">{{ $item->category }}</option>
                                    <option value="cat 1">Catagory One</option>
                                    <option value="cat 2">Category Two</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">Unit</label>
                                <input  type="text" name="unit"  class="form-control" required value="{{ $item->unit }}"/>
                            </div>

                        </div>

                        <div class="row pb-2">
                            <div class="col-lg-4">
                                <label class="form-label">Dimensions </label>
                                <input  type="text" name="dimension" class="form-control"  value="{{ $item->dimension }}"/>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">weight</label>
                                <input  type="number" step="any" name="weight"  class="form-control" value="{{ $item->weight }}"/>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">Manufacturer</label>
                                <input  type="text" name="manufacturer" class="form-control" value="{{ $item->manufacturer }}"/>
                            </div>

                        </div>

                        <div class="row pb-2">
                            <div class="col-lg-4">
                                <label class="form-label">Part Number</label>
                                <input  type="text"  name="part_number"  class="form-control" value="{{ $item->part_number }}"/>
                            </div>

                            <div class="col-lg-4">
                                <label class="form-label">Model</label>
                                <input  type="text" name="model" class="form-control"  value="{{ $item->model }}"/>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">Serial Number</label>
                                <input  type="text"  name="serial_number"  class="form-control" value="{{ $item->serial_number }}"/>
                            </div>


                        </div>

                        <div class="row pb-2">
                            <div class="col-lg-4">
                                <label class="form-label">Bar Code</label>
                                <input  type="text" name="bar_code" class="form-control" value="{{ $item->bar_code }}"/>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">Last Unit Cost</label>
                                <input  type="text" name="cost_price" class="form-control"value="{{ $item->cost_price }}"/>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">Retail Price</label>
                                <input  type="number" step="any" name="retail_price" class="form-control"  value="{{ $item->retail_price }}"/>
                            </div>


                        </div>

                        <div class="row pb-2">
                            <div class="col-lg-4">
                                <label class="form-label">Wholesale Price</label>
                                <input  type="number" step="any" name="whole_sale_price"  class="form-control" value="{{ $item->whole_sale_price }}"/>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">Reorder Quantity</label>
                                <input  type="number" step="any" name="reorder_level" class="form-control"  value="{{ $item->reorder_level }}"/>
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">Beginning Quantity *</label>
                                <input  type="number" step="any" name="start_balance" class="form-control" required value="{{ $item->start_balance }}"/>
                            </div>

                        </div>

                        <div class="row pb-2">
                            <div class="col-lg-4">
                            </div>
                            <div class="col-lg-8">
                                <label class="form-label">Supplier Name</label>
                                <select class="form-control" name="vendor_id"  data-toggle="select2">
                                    <option value="{{ $item->vendor_id }}">@if ($item->vendor_id) {{ $item->vendor->name }} @endif</option>
                                    @forelse ($vendors as $vendor )
                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                    @empty

                                    @endforelse
                                </select>
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
