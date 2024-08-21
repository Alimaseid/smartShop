@extends('inc.frame')
{{-- <title>ERP-Inventory-Shops</title> --}}

@section('content')
@include('inc.message')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">
            shop <i class="fa fa-plus"></i></button></h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                    <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                    <li class="breadcrumb-item active">shop</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-12">

        <!-- Pricing Title-->
        <div class="text-center pb-2">
            <h3 class="mb-2">Our <span class="text-primary">shop</span></h3>
            {{-- <p class="text-muted w-50 m-auto">
                We have plans and prices that fit your business perfectly. Make your client site a success with our products.
            </p> --}}
        </div>

        <!-- Plans -->
        <div class="row my-3">
        @forelse ($shops as $shop )
            <div class="col-xl-3 col-md-6" >
                <div class="card card-pricing">
                    <div class="card-body text-center">
                        <p class="card-pricing-plan-name fw-bold text-uppercase">{{$shop->name}}</p>
                        {{-- <h2 class="card-pricing-price">$9 <span>/ Month</span></h2> --}}
                        <ul class="card-pricing-features">
                            <li>Manage By <br> <b>{{$shop->manage_by}}</b></li>
                            <li>Address<br> <b>{{$shop->address}}</b></li>
                            <li>Value <br><b>{{$shop->value}}</b></li>
                            <li>Items <br> <b>{{$shop->no_items}}</b></li>
                            {{-- <li class="text-sm p-2 ">{{$shop->description}}</li> --}}

                        </ul>
                        <div class="row p-2">
                          <div class="col-lg-4">
                            <button class="btn btn-primary btn-sm"
                            data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg-{{$shop->id}}">
                            <i class="fa fa-edit"></i></button>
                          </div>
                          <div class="col-lg-4">
                            {{-- <div class="d-grid"> --}}
                            {{-- </div> --}}
                          </div>
                          <div class="col-lg-4">
                            <a href="store-{{$shop->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                          </div>
                        </div>

                    </div>
                </div> <!-- end Pricing_card -->
            </div> <!-- end col -->
        @empty
             <h3 class="text-primary">No shop list Found !</h3>
        @endforelse
    </div>

        <!-- end row -->

    </div> <!-- end col-->
</div>

{{-- add new shop --}}

<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">New shop</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="shop" method="post" class="parsley-examples">
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
                                        <label class="form-label">ManageBy</label>
                                        <div>
                                            <input type="text" name="manage_by"
                                                   class="form-control"
                                                   placeholder="ManageBy"/>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Address</label>
                                        <div>
                                            <input type="text" name="address"
                                                   class="form-control"
                                                   placeholder="Address"/>
                                        </div>
                                    </div>


                                    <div class="mb-2">
                                        <label class="form-label">Textarea</label>
                                        <div>
                                            <textarea class="form-control" name="description"></textarea>
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



@forelse ($shops as $shop)
<div class="modal fade" id="bs-example-modal-lg-{{$shop->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit <i class="text-info">{{$shop->name}}</i></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="store-{{$shop->id}}" method="post" class="parsley-examples">
                                    @csrf
                                    <div class="mb-2">
                                        <label class="form-label">Name</label>
                                        <div>
                                            <input  type="text" name="name" value="{{$shop->name}}"
                                                   class="form-control" required
                                                   placeholder="Name"/>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">ManageBy</label>
                                        <div>
                                            <input type="text" name="manage_by" value="{{$shop->manage_by}}"
                                                   class="form-control"
                                                   placeholder="ManageBy"/>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Address</label>
                                        <div>
                                            <input type="text" name="address" value="{{$shop->address}}"
                                                   class="form-control"
                                                   placeholder="ManageBy"/>
                                        </div>
                                    </div>


                                    <div class="mb-2">
                                        <label class="form-label">Textarea</label>
                                        <div>
                                            <textarea class="form-control" name="description">{{$shop->description}}</textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <button type="submit" onclick="return alert('are you sure save change.')" class="btn btn-primary waves-effect waves-light me-1">
                                                Save Changes
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@empty

@endforelse


@endsection
