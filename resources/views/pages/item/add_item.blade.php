@extends('inc.frame')
@section('content')
   @include('inc.message')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">New Item Form</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item"><a href="/items">Items</a></li>
                        <li class="breadcrumb-item active">ADD Item</li>
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
                        <form action="item" method="post" class="parsley-examples">
                            @csrf
                            <div class="row pb-2">
                                <div class="col-lg-4">
                                    <label class="form-label">Item Number</label>
                                    <input  type="text" name="item_number" class="form-control"  placeholder="Item Number"/>
                                </div>
                                <div class="col-lg-8">
                                    <label class="form-label">Description *</label>
                                    <input  type="text" name="name" class="form-control" required placeholder="Description"/>
                                </div>
                            </div>

                            <div class="row pb-2">
                                <div class="col-lg-4">
                                    <label class="form-label">Item Class </label>
                                    <select name="item_class" class="form-control" id="" required>
                                        <option value="Stok Item">Stok Item</option>
                                        <option value="Non-Stock Item">Non-Stock Item</option>
                                        <option value="Service">Service</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Category</label>
                                    <a style="float: right;" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg"> <i class="fa fa-plus-circle"></i></a>
                                    <select name="category"  required class="form-control" id="">
                                        <option value="">Select</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Unit</label>
                                    <input  type="text" name="unit"  class="form-control" required  placeholder="Unit"/>
                                </div>

                            </div>

                            <div class="row pb-2">
                                <div class="col-lg-4">
                                    <label class="form-label">Dimensions </label>
                                    <input  type="text" name="dimension" class="form-control"  placeholder="Length x Width x Height"/>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">weight</label>
                                    <input  type="number" step="any" name="weight"  class="form-control" placeholder="weight"/>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Manufacturer</label>
                                    <input  type="text" name="manufacturer" class="form-control"  placeholder="Manufacturer"/>
                                </div>

                            </div>

                            <div class="row pb-2">
                                <div class="col-lg-4">
                                    <label class="form-label">Part Number</label>
                                    <input  type="text"  name="part_number"  class="form-control" placeholder="Part Number"/>
                                </div>

                                <div class="col-lg-4">
                                    <label class="form-label">Model</label>
                                    <input  type="text" name="model" class="form-control"  placeholder="Model"/>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Serial Number</label>
                                    <input  type="text"  name="serial_number"  class="form-control" placeholder="Serial Number"/>
                                </div>


                            </div>

                            <div class="row pb-2">
                                <div class="col-lg-4">
                                    <label class="form-label">Bar Code</label>
                                    <input  type="text" name="bar_code" class="form-control"  placeholder="Bar Code"/>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Last Unit Cost</label>
                                    <input  type="text" name="cost_price" class="form-control" placeholder="Last Unit Cost"/>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Retail Price</label>
                                    <input  type="number" step="any" name="retail_price" class="form-control"  placeholder="Retail Price"/>
                                </div>


                            </div>

                            <div class="row pb-2">
                                <div class="col-lg-4">
                                    <label class="form-label">Wholesale Price</label>
                                    <input  type="number" step="any" name="whole_sale_price"  class="form-control"  placeholder="Wholesale Price"/>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Reorder Quantity</label>
                                    <input  type="number"  step="any" name="reorder_level" class="form-control"  placeholder="Reorder Quantity"/>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label">Beginning Quantity</label>
                                    <input  type="number" step="any" name="start_balance" value="0" class="form-control" required placeholder="Beginning Quantity"/>
                                </div>

                            </div>

                            <div class="row pb-2">
                                <div class="col-lg-4">
                                </div>
                                <div class="col-lg-8">
                                    <label class="form-label">Supplier Name</label>
                                    <select class="form-control" name="vendor_id"  data-toggle="select2">
                                        <option value="">Select Supplier</option>
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

    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">New Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="category" method="post" class="parsley-examples">
                                        @csrf
                                        <div class="mb-2">
                                            <label class="form-label">Name</label>
                                            <div>
                                                <input  type="text" name="name"
                                                       class="form-control" required
                                                       placeholder="Name"/>
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <label class="form-label">Textarea</label>
                                            <div>
                                                <textarea class="form-control" name="description"></textarea>
                                            </div>
                                        </div>
                                        <div>
                                            <div style="float: right">
                                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light me-1">
                                                    Submit
                                                </button>
                                                <button type="reset" class="btn btn-secondary btn-sm waves-effect">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <hr style="float: right">
                                    <table>
                                        @forelse ($categories as $category)
                                        <tr>
                                            <th>{{ $category->name }}</th>
                                            <td> <small><i>{{ $category->description }}</i></small> </td>
                                            <td><a href="deleteCategory-{{ $category->id }}" class="btn btn-sm"><i class="fa fa-trash"></i></a></td>
                                        </tr>

                                        @empty
                                        @endforelse

                                    </table>
                                </div>

                            </div> <!-- end card -->
                        </div> <!-- end col-->


                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
