@extends('inc.frame')

@section('content')
@include('inc.message')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Goods Receiving</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item"><a href="/purchase">Received Goods</a></li>
                        <li class="breadcrumb-item active">Receiving Goods</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="purchase" method="post">
                    @csrf
                <div class="card-header border-bottom bg-transparent">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="header-title mb-0">Goods Receiving Form</h5>
                        </div>

                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-2">
                            <input type="date" name="date" class="form-control" value="{{ now()->toDateString() }}" id="">
                        </div>
                    </div>


                </div>
                <div class="card-body">

                    <div class="row">
                         <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                    <label for="">Supplier</label>
                                    <select class="form-control" name="vendor_id" required data-toggle="select2">
                                        <option value="">Select Supplier</option>
                                        @forelse ($vendors as $vendor )
                                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <label for="">Invoice No#</label>
                                    <input type="text" class="form-control" step="any" name="invoice_no" value="MN-{{ rand(10000,99999) }}">
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <label for="">Location</label>
                                    <select class="form-control" name="warehouse_id" required data-toggle="select2">
                                        <option value="">Select Location</option>
                                        @forelse ($locations as $location )
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                            </div>
                         </div>
                         <div class="col-lg-4">
                            <div class="col-lg-12 col-sm-12">
                                <div class="row">
                                    {{-- <div class="col-lg-6">
                                        <label for="">Requisition#</label>
                                        <select class="form-control" name="requisition_id" data-toggle="select2">
                                             <option value="">Requisition No</option>
                                             @forelse ($requisitions as $requisition )
                                                <option value="{{ $requisition->id }}">{{ $requisition->requisition_no }}</option>
                                             @empty

                                             @endforelse
                                        </select>
                                    </div> --}}
                                    <div class="col-lg-6">
                                        <label for="" >Supplire's Invoice No#</label>
                                        <input type="text" class="form-control" step="any"  name="vendor_invoice_no">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="row">
                            <div class="col-lg-8 mb-2">
                                <div>
                                    <div class="table-responsive" >
                                        <table class="table table-centered border table-nowrap mb-lg-0" >
                                            <thead class="bg-light">
                                                <tr>
                                                    <th style="width: 35%;">
                                                       <select class="form-control" name="list[0][item_id]" id="item_id" onchange="getItemInfo()" data-toggle="select2">
                                                         <option value="">Select Product</option>
                                                        @forelse ($items as $item )
                                                            <option value="{{ $item->id }}">{{ $item->name }} &nbsp; &nbsp; &nbsp; &nbsp; #{{ $item->item_number }}</option>
                                                        @empty
                                                        @endforelse
                                                        </select>
                                                    </th>
                                                    <input type="hidden" id="unit">
                                                    <input type="hidden" id="item_name">

                                                    <th>
                                                        <input type="number" onchange="getTotal()" id="quantity" step="any" min="0" name="list[0][quantity]"class="form-control" placeholder="Quantity">
                                                    </th>
                                                    <th>
                                                        <input type="number" onchange="getTotal()" id="price" step="any" min="0" name="list[0][price]"class="form-control" placeholder="U-Price" >
                                                    </th>
                                                    <th>
                                                        <input type="number" id="total" step="any" min="0"  required name="list[0][total]"class="form-control" placeholder="Total" readonly>

                                                    </th>
                                                    <th>
                                                        <a class="btn btn-primary" onclick="addList()"><i class="fa fa-plus"></i></a>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row pb-2">
                                    <div class="col-lg-6">
                                        <label for="">Tax</label>
                                        <input type="number"  class="form-control" step="any"  onchange="getTotal()" min="0" name="tax" id="tax_value" value="0">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Discount%</label>
                                        <input type="number" class="form-control" step="any"  onchange="getTotal()" max="100" name="discount" id="discount" value="0">

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table table-centered border table-nowrap mb-lg-0" id="itemList">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                    <th></th>

                                                </tr>
                                            </thead>
                                            <tbody >

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="row pb-2">
                                    <div class="col-lg-12">
                                        <label for="">Remark</label>
                                        <textarea name="remark" rows="2" class="form-control" placeholder="Remark..."></textarea>
                                    </div>

                                </div>
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
                                                    <td> <i id="my_discount">0</i></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Sub Total :</th>
                                                    <td> <i id="all_sub">0</i></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Tax :</th>
                                                    <td><i id="tax">0</i></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Total :</th>
                                                    <td><i id="all_total">0</i></td>
                                                    <input type="hidden" name="total" id="all_total">

                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="row m-2">
                                            <button style="float: right;" disabled id="submiter" class="btn btn-primary" type="submit">Submit</button>
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

    function getTotal(){
        var price = $("#price").val();
        var quantity = $("#quantity").val();
        var tax = $("#tax_value").val();
        var discount = $("#discount").val();

        document.getElementById('total').value = price *quantity;

        var subTotalList = document.getElementsByClassName('tot');
            var gsubtotal = 0;
            for (const element of subTotalList) {
                gsubtotal = gsubtotal + parseInt(element.innerHTML);
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
</script>
<script>
     var i = 0;

      // Add an item
      function addList() {
        var item_id = $("#item_id").val();
        var quantity = $("#quantity").val();
        var price = $("#price").val();
        var unit = $("#unit").val();
        var item = $("#item_name").val();
        var discount = $("#discount").val();
        var subtotal = price * quantity;

        if(item_id != '' && quantity != 0 && price != 0){
        document.getElementById('submiter').disabled = false;

            var List = `
             <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="flex-1">
                            <h5 class="m-0">`+item+`</h5>
                            <p class="mb-0">Unit : `+unit+`</p>
                        </div>
                    </div>
                </td>
                <td>`+quantity+`</td>
                <td>`+price+`</td>
                <td class="tot">`+subtotal+`</td>
                <td> <button class='remove btn btn-danger btn-sm' onclick="removeRow(this)" style="float:right;">
                    <i class='fa fa-trash'></i></button>
                </td>

                </i><input type='hidden' name='product_list[`+i+`][item_id]' value='`+item_id+`'>
                "<input type='hidden' name='product_list[`+i+`][item]' value='`+item+`'>
                "<input type='hidden' name='product_list[`+i+`][price]' value='`+price+`''>
                "<input type='hidden' name='product_list[`+i+`][unit]' value='`+unit+`''>
                "<input type='hidden' name='product_list[`+i+`][quantity]' value='`+quantity+`''>
                "<input type='hidden' name='product_list[`+i+`][subtotal]' value='`+subtotal+`''>
            </tr>
         `;
         $("#itemList tbody").append(List);
          $("#item_id").val("");
          $("#item").val("");
          $("#quantity").val("");
          $("#price").val("");
          $("#total").val("");
          ++i;


          var subTotalList = document.getElementsByClassName('tot');
            var gsubtotal = 0;
            for (const element of subTotalList) {
                gsubtotal = gsubtotal + parseInt(element.innerHTML);
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
        }else{
            alert("Please Fill All Items Data First !");
        }
      }

      function removeRow(button) {
        // Get the parent <tr> element of the clicked button
        var row = button.parentNode.parentNode;

        // Remove the <tr> element from its parent (in this case, the <table>)
        row.parentNode.removeChild(row);
        getTotal();
        }


</script>

@endsection
