@extends('inc.frame')

@section('content')
@include('inc.message')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">create Opening Balance </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                    <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                    <li class="breadcrumb-item active">new Adjestment</li>
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
                    <div class="card-body">
                        <form action="createOpeningBalance-{{$Id}}" method="post" class="parsley-examples">
                            @csrf

                            <div class="row pb-3">
                                <div class="col-lg-6">
                                    <label class="form-label">Item</label>
                                    <input  type="text"  name=""  class="form-control" readonly value="{{$item->name}}"/>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Location</label>
                                    <select class="form-control" name="warehouse_id" required data-toggle="select2">
                                        <option value="">Select Location</option>
                                        @forelse ($warehouses as $warehouse )
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                            </div>

                            <div class="row pb-3">
                                <div class="col-lg-6">
                                    <label class="form-label">Quantity</label>
                                    <input  type="number"  name="quantity"  class="form-control" placeholder="quantity"/>
                                </div>
                                <div class="col-lg-6">
                                <label class="form-label">Remark</label>
                                <div>
                                    <textarea class="form-control" name="remark"></textarea>
                                </div>
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
                </div>
            </div> <!-- end card -->
        </div> <!-- end col-->
    </div>
</div>
@endsection
