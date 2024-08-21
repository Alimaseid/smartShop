@extends('inc.frame')

@section('content')
@include('inc.message')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                {{-- <h4 class="page-title">
                    <button class="btn btn-info btn-sm" onclick="getForm()">
                Goods Receiving <i class="fa fa-plus"> </i></button></h4> --}}
                <h4 class="page-title">
                    <a href="/add-purchase" class="btn btn-primary" >
                        <i class="fa fa-plus-circle"> </i> Purchase </a></h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item active">Purchase</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    {{-- <div class="row" id='my-form' style="display: none">
        <div class="col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <p class="sub-header">
                       <a class="btn btn-sm btn-danger" style="float: right" onclick="getForm()"><b>X</b></a>
                    </p>

                    <form action="purchase" method="post" class="parsley-examples">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="inputAddress" class="form-label">Date</label>
                                    <input type="date" class="form-control" name="requisition_date" required id="inputAddress" value="{{ Carbon\Carbon::now()->toDateString(); }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="inputAddress" class="form-label">#Invoice</label>
                                    <input type="text" class="form-control" name="invoice_no" required id="inputAddress" value="{{ rand(100000,999999) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="inputAddress" class="form-label">Supplier</label>
                                    <select class="form-control" name="vendor_id" required data-toggle="select2">
                                        <option value=""></option>
                                        @forelse ($vendors as $vendor )
                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                        @empty
                                        @endforelse
                                     </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="inputAddress" class="form-label">#Requisition No</label>
                                    <select class="form-control" name="requisition_id" required data-toggle="select2">
                                        <option value=""></option>
                                        @forelse ($requisitions as $requisition )
                                        <option value="{{ $requisition->requisition_no }}">{{ $requisition->requisition_no }}</option>
                                        @empty
                                        @endforelse
                                     </select>
                                </div>
                            </div>
                        </div>


                        <div class="row p-2">
                            <div class="col-md-4"><b>Product</b></div>
                            <div class="col-md-3"><b>Quantity</b></div>
                            <div class="col-md-2"><b>Unit</b></div>
                            <div class="col-md-3">Remark</div>
                        </div>

                        <div class="row" id="add_items">
                            <div class="row">
                                <div class="col-md-4">
                                    <select class="form-control" name="list[0][item_id]" required data-toggle="select2">
                                         <option value=""></option>
                                       @forelse ($items as $item )
                                           <option value="{{ $item->id }}">{{ $item->name }}</option>
                                       @empty

                                       @endforelse
                                      </select>
                                </div>
                                <div class="col-md-2"><input type="number" step="any" min="0"  required name="list[0][quantity]"class="form-control" name="" id=""></div>
                                <div class="col-md-2"><input type="text" required name="list[0][unit]" class="form-control" name="" id=""></div>
                                <div class="col-md-3"><input type="text"  name="list[0][remarks]"class="form-control"></div>
                                <div class="col-md-1">-</div>
                            </div>
                        </div>
                        <a href="#" onclick="add_new_items()" style="float: right"  class="btn btn-purple btn-sm ">
                            <i class="bx bx-plus-circle" aria-hidden="true"></i>
                        </a>
                        <br>
                        <hr>
                        <button type="submit"  class="btn btn-primary">Send</button>
                    </form>


                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" style="font-size:12px" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th>Invoice#</th>
                                <th>Tax</th>
                                <th>Discount</th>
                                <th>SubTotal</th>
                                <th>Total</th>
                                <th>_______</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0; @endphp
                               @forelse ($purchases as $purchase)
                                 @php $no = $no + 1; @endphp

                                   <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $purchase->created_at->toDateString() }}</td>
                                    <td>{{ $purchase->vendor->name }}</td>
                                    <td>{{ $purchase->invoice_no }}</td>
                                    {{-- <td>
                                        @if ($purchase->requisition !=  null)
                                        {{ $purchase->requisition->requisition_no }}
                                        @endif
                                    </td> --}}
                                    <td>{{ $purchase->tax }} %</td>
                                    <td>{{ $purchase->discount }} %</td>
                                    <td>{{ $purchase->subtotal }}</td>
                                    <td>{{ $purchase->total }}</td>
                                    <td style="width: 10%">
                                        <a href="purchase-{{ $purchase->id }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="purchaseDelete-{{ $purchase->id }}" onclick="return confirm('Are You Sure Remove This Purchase ?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

    {{-- <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card text-center">
                <div class="card-body">
                    <input type="text" id="search-results" class="form-control p-2" placeholder="search" name="" id="">
                    <ul class="list-group list-group-flush text-primary nav nav-pills navtab-bg">
                        @forelse ($requisitions as $rqs)
                        <li class="list-group-item p-3 nav-item">
                            <a href="#{{ $rqs->id }}" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-cog me-1"></i>{{ $rqs->created_at->toDateString() }}, {{ $rqs->description_title}}
                            </a>
                        </li>
                        @empty

                        @endforelse
                    </ul>
                </div>
            </div> <!-- end card-box -->
        </div> <!-- end col-->
        <div class="col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-body">

                    <div class="tab-content">
                        @forelse ($requisitions as $rqs)
                        <div class="tab-pane" id="edit{{ $rqs->id }}">
                            <form action="requisition-{{ $rqs->id }}" method="post" class="parsley-examples">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="inputAddress" class="form-label">Date</label>
                                            <input type="date" class="form-control" name="requisition_date" readonly required id="inputAddress" value="{{ $rqs->created_at->toDateString() }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-2">
                                            <label for="inputAddress" class="form-label">#RQST</label>
                                            <input type="text" class="form-control" name="requisition_no" readonly required id="inputAddress" value="{{ $rqs->requisition_no}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-lg-12">
                                        <div class="mb-2">
                                            <label for="inputAddress" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="description_title" value="{{ $rqs->description_title}}" >
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mb-2">
                                            <label for="inputAddress" class="form-label">Description</label>
                                            <textarea name="description" class="form-control" placeholder="Note...">{{ $rqs->description}}</textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="row p-2">
                                    <div class="col-md-4"><b>Product</b></div>
                                    <div class="col-md-3"><b>Quantity</b></div>
                                    <div class="col-md-2"><b>Unit</b></div>
                                    <div class="col-md-3">Remark</div>
                                </div>

                                <div class="row" id="add_items">
                                    @php $no = 0; @endphp
                                    @forelse ($rqs->requisitionDetails as $list)
                                    @php $no = $no + 1; @endphp

                                        <div class="row p-2">
                                            <div class="col-md-4">
                                                <select class="form-control" name="list[{{ $no }}][item_id]" required data-toggle="select2">
                                                    <option value="{{ $list->item_id }}">{{ $list->item->name }}</option>
                                                @forelse ($items as $item )
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @empty

                                                @endforelse
                                                </select>
                                            </div>
                                            <div class="col-md-2"><input type="number" value="{{ $list->quantity }}" step="any" min="0"  required name="list[{{ $no }}][quantity]"class="form-control" name="" id=""></div>
                                            <div class="col-md-2"><input type="text" value="{{ $list->unit }}" required name="list[{{ $no }}][unit]" class="form-control" name="" id=""></div>
                                            <div class="col-md-3"><input type="text" value="{{ $list->remarks }}" name="list[{{ $no }}][remarks]"class="form-control"></div>
                                            <div class="col-md-1">-</div>
                                        </div>
                                    @empty

                                    @endforelse
                                </div>
                                <br>
                                <button type="submit" onclick="return confirm('Are You Sure Save Changes ?')"  class="btn btn-success" style="float: right">Save Changes</button>
                                <br>
                            </form>
                            <hr>

                        </div>
                        <div class="tab-pane" id="{{ $rqs->id }}">
                            <ul class="list-unstyled timeline-sm">
                                <li class="timeline-sm-item">
                                    <span class="timeline-sm-date">
                                        <ul class="nav nav-pills navtab-bg">
                                            <li class="nav-item">
                                                <a href="#edit{{ $rqs->id }}" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                                    <i class="mdi mdi-cog me-1"></i>Edit
                                                </a>
                                            </li>
                                        </ul>
                                        <i class="p-2"> <small>Status: <b class=" text-purple">{{ $rqs->status }}</b> </small></i>
                                    </span>
                                    <h5 class="mt-0 mb-1">{{ $rqs->description_title }}</h5>

                                        <p>On:  {{ $rqs->created_at->toDateString() }} <i style="float: right">  #No: {{ $rqs->requisition_no }}</i> </p>
                                    <p class="text-muted mt-2">{{ $rqs->description }}</p>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <caption>List of riquistion items</caption>
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Unit</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 0; @endphp
                                                @forelse ($rqs->requisitionDetails as $list)
                                                @php $no = $no + 1; @endphp

                                                <tr>
                                                    <th scope="row">{{ $no }}</th>
                                                    <td>{{ $list->item->name }}</td>
                                                    <td>{{ $list->quantity }}</td>
                                                    <td>{{ $list->unit }}</td>
                                                    <td>{{ $list->remarks }}</td>

                                                </tr>
                                                @empty

                                                @endforelse
                                            </tbody>
                                        </table>

                                    </div>
                                </li>

                            </ul>


                        </div>
                        <!-- end timeline content-->


                        @empty

                        @endforelse

                        <!-- end settings content-->

                    </div> <!-- end tab-content -->
                </div>
            </div> <!-- end card-->

        </div> <!-- end col -->

    </div> --}}
    <!-- end row-->

</div> <!-- container-fluid -->







<script>
    document.querySelector('#search-results').addEventListener('input', filterList);
    function filterList() {
       const filter =  document.querySelector('#search-results').value.toLowerCase();
       const listItems = document.querySelectorAll('.list-group-item');
       listItems.forEach((item) => {
                  let text = item.textContent;
                  if(text.toLowerCase().includes(filter.toLowerCase())){
                    item.style.display = '';
                  }else{
                    item.style.display = 'none';
                  }
       });
    }



    var i = 0;
var subTotal = [];
function add_new_items() {
    ++i;
    $("#add_items").append(`
    <div class="row p-2" id=`+i+`>
        <div class="col-md-4">
            <select class="form-control" name="list[`+ i +`][item_id]" required data-toggle="select2" id="select-`+i+`">
                    <option value=""></option>
                @forelse ($items as $item )
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @empty

                @endforelse
            </select>
        </div>
        <div class="col-md-2"><input type="number" min="0" step="any"  name="list[`+ i +`][quantity]"class="form-control" required name="" id=""></div>
        <div class="col-md-2"><input type="text" name="list[`+ i +`][unit]" class="form-control" required name="" id=""></div>
        <div class="col-md-3"><input type="text" name="list[`+ i +`][remarks]"class="form-control"></div>
        <div class="col-md-1"><a><B style="color:red" onclick="remove(`+i+`)">X</B></a></div>
    </div>

    `);

$(function() {
    "use strict";
     $( '#select-'+i ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        closeOnSelect: false,
        dropdownParent: $( '#select-'+i ).parent(),
    } );
    });
};
 function remove (i) {
    // document.getElementById(i).style.display = 'none';
    document.getElementById(i).remove();
};
</script>
<script>
    function getForm(){
     var x = document.getElementById('my-form');
     if (x.style.display === "none") {
         x.style.display = "block";
         } else {
         x.style.display = "none";
     }

    }
 </script>

@endsection
