@extends('inc.frame')

@section('content')
@include('inc.message')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Edit quotation Quotation</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item"><a href="/sales-quotation">quotation Quotation</a></li>
                        <li class="breadcrumb-item active">Product quotation - {{ $quotation->invoice_no }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                {{-- <a href="javascript:window.print()" style="float: right;" class="btn btn-primary waves-effect waves-light me-1 d-print-none"><i class="mdi mdi-printer me-1"></i> Print</a> --}}

                <form action="salesQuotation-{{ $quotation->id }}" method="post">
                    @csrf
                <div class="card-header border-bottom bg-transparent">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="header-title mb-0"> Edit Sale Quotation</h5>
                        </div>

                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-2">
                            <input type="date" name="date" class="form-control" value="{{ $quotation->date }}" id="">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                           <div class="row">
                               <div class="col-lg-4 col-sm-6">
                                   <label for="">Customer</label>
                                   <select class="form-control" name="customer_id" required data-toggle="select2">
                                       <option value="{{ $quotation->customer_id }}">{{ $quotation->customer->name }}</option>
                                       @forelse ($customers as $customer )
                                           <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                       @empty
                                       @endforelse
                                   </select>
                               </div>
                               <div class="col-lg-4 col-sm-6">
                                   <label for="">Invoice No#</label>
                                   <input type="text" class="form-control" step="any" name="invoice_no" value="{{ $quotation->invoice_no }}">
                               </div>
                               <div class="col-lg-4 col-sm-6">
                                <label for="">Expiration Date</label>
                                <input type="date" name="expiration_date" class="form-control" value="{{ $quotation->expiration_date }}" id="">

                            </div>

                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="col-lg-12 col-sm-12">
                               <div class="row">
                                <div class="col-lg-6">

                                    <label for="" >Payment Terms</label>
                                    <select name="payment_term" class="form-control" id="">
                                        <option value="{{ $quotation->payment_term }}">{{ $quotation->payment_term }}</option>
                                        <option value="PIA">PIA</option>
                                        <option value="CIA ">CIA </option>
                                        <option value="COD ">COD </option>
                                        <option value="CND ">CND </option>
                                        <option value="CBS ">CBS </option>
                                        <option value="CWO ">CWO </option>
                                        <option value="Upon receipt ">Upon receipt </option>
                                        <option value="Net 7 ">Net 7 </option>
                                        <option value="Net 21 ">Net 21 </option>
                                        <option value="Net 60">Net 60 </option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Due Date</label>
                                    <input type="date" name="due_date" value="{{ $quotation->due_date }}" class="form-control" required id="">
                                </div>
                               </div>

                           </div>

                       </div>
                   </div>
                    <div class="mt-2">
                        <div class="row">
                            <div class="col-lg-8">

                            </div>
                            <div class="col-lg-4">

                            </div>

                            <div class="col-lg-8">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table table-centered border table-nowrap mb-lg-0" id="itemList">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th style="width: 30%;">Product</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                    <th></th>

                                                </tr>
                                            </thead>
                                            <tbody >
                                                @php $no = 0;  @endphp
                                                @forelse ($quotation->details as $detail)
                                                    <tr>
                                                       <td>
                                                        <select class="form-control" name='product_list[{{ $no }}][item_id]' id="item_id" onchange="getItemInfo()" data-toggle="select2">
                                                            <option value="{{ $detail->item_id }}">{{ $detail->item->name }} &nbsp; &nbsp; &nbsp; &nbsp; #{{ $detail->item->item_number }}</option>

                                                           {{-- @forelse ($items as $item )
                                                               <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                           @empty
                                                           @endforelse --}}
                                                          </select>
                                                       </td>
                                                       <td> <input type='number' id="quantity-{{ $no }}" onchange="getTotal({{ $no }})" class ="form-control" step="any" min="0" name='product_list[{{ $no }}][quantity]' value='{{ $detail->quantity }}' </td>
                                                       <td> <input type='number' id="price-{{ $no }}" onchange="getTotal({{ $no }})" class ="form-control" step="any" min="0" name='product_list[{{ $no }}][price]' value='{{ $detail->unit_price }}' </td>
                                                       <td> <input type='number' id="total-{{ $no }}" class ="form-control tot" readonly min="0" name='product_list[{{ $no }}][subtotal]' value='{{ $detail->amount }}' </td>


                                                        <input type='hidden' name='product_list[{{ $no }}][unit]' value='{{ $detail->unit}}'>

                                                    </tr>

                                                @php $no = $no + 1;  @endphp

                                                @empty

                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                    <div class="row pb-2">
                                        <div class="col-lg-6">
                                            <label for="">Tax</label>
                                            <input type="number"  class="form-control" step="any"  onchange="allTotal()" min="0" name="vat" id="tax_value" value="{{ $quotation->vat }}">
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="">Discount%</label>
                                            <input type="number" class="form-control" step="any"  onchange="allTotal()" max="100" name="discount" id="discount" value="{{ $quotation->discount }}">

                                        </div>
                                    </div>

                                <div class="row pb-2">
                                    <div class="col-lg-12">
                                        <label for="">Remark</label>
                                        <textarea name="remark" rows="2" class="form-control" placeholder="Remark...">{{ $quotation->remark }}</textarea>
                                    </div>

                                </div>
                                @php
                                   $tax_val = $quotation->sub_total * $quotation->vat / 100 ;
                                   $discount_val = $quotation->sub_total * $quotation->discount / 100 ;
                                @endphp
                                <div>
                                    <div class="table-responsive">
                                        <table class="table table-centered border mb-0">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th colspan="2">Summary
                                                   </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Discount :</th>
                                                    <td> <i id="my_discount">{{ $discount_val }}</i></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Sub Total :</th>
                                                    <td> <i id="all_sub">{{ $quotation->sub_total }}</i></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Tax :</th>
                                                    <td><i id="tax">{{ $tax_val }}</i></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Total :</th>
                                                    <td><i id="all_total">{{ $quotation->total }}</i></td>
                                                    <input type="hidden" name="total" id="all_total">

                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="row m-2">
                                            <button style="float: right;" id="submiter" class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- end card -->

        </div>
    </div>
</div>

<script>
    function getItemInfo(){
        const id = document.getElementById('item_id').value;
        $.ajax({
            url: "api/getProductInfo/"+id,
            type: "GET",
            success: function(res) {
            // console.log(res);
            document.getElementById('unit').value = res.unit ;
            document.getElementById('item_name').value = res.name ;
            }
        });

    }

    function getTotal(no){
        var price = $("#price-"+no).val();
        var quantity = $("#quantity-"+no).val();
        var tax = $("#tax_value").val();
        var discount = $("#discount").val();

        document.getElementById('total-'+no).value = price *quantity;

        var subTotalList = document.getElementsByClassName('tot');
            var gsubtotal = 0;
            for (const element of subTotalList) {
                gsubtotal = gsubtotal + parseInt(element.value);
            }
            var tax = $("#tax_value").val();
            var myDiscount = gsubtotal * discount / 100;
            var sub = gsubtotal - myDiscount;
            var mytax = tax * sub / 100;
            var total = sub  + mytax;
            document.getElementById("all_sub").innerHTML = sub.toLocaleString('en-US');
            document.getElementById("tax").innerHTML = mytax.toLocaleString('en-US');
            document.getElementById("all_total").innerHTML = total.toLocaleString('en-US');
            document.getElementById("my_discount").innerHTML = myDiscount.toLocaleString('en-US');

    }
    function allTotal(){

        var tax = $("#tax_value").val();
        var discount = $("#discount").val();

        var subTotalList = document.getElementsByClassName('tot');
            var gsubtotal = 0;
            for (const element of subTotalList) {
                gsubtotal = gsubtotal + parseInt(element.value);
            }
            var tax = $("#tax_value").val();
            var myDiscount = gsubtotal * discount / 100;
            var sub = gsubtotal - myDiscount;
            var mytax = tax * sub / 100;
            var total = sub  + mytax;
            document.getElementById("all_sub").innerHTML = sub.toLocaleString('en-US');
            document.getElementById("tax").innerHTML = mytax.toLocaleString('en-US');
            document.getElementById("all_total").innerHTML = total.toLocaleString('en-US');
            document.getElementById("my_discount").innerHTML = myDiscount.toLocaleString('en-US');

    }

    function initFormAdvance() {
        // Select2
        if (jQuery().select2) {
            $('[data-toggle="select3"]').select3();
        }
    }
</script>


@endsection
