@extends('inc.frame')

@section('content')
@include('inc.message')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Item Transfer</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item"><a href="/transefer-item">Transfers</a></li>
                        <li class="breadcrumb-item active">New Transfer</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="item-transfer" method="post">
                    @csrf
                <div class="card-header border-bottom bg-transparent">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="header-title mb-0">Transfer Form</h5>
                        </div>

                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-2">
                            <input type="date" name="date" required class="form-control" value="{{ now()->toDateString() }}" id="">
                        </div>
                    </div>


                </div>
                <div class="card-body">

                    <div class="row">
                         <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                    <label for="">Reference No#</label>
                                    <input type="text" class="form-control" step="any" required name="rf_number" value="MN-{{ rand(10000,99999) }}">
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <label for="">From</label>
                                    <select class="form-control" name="location_from" required data-toggle="select2">
                                        <option value="">Select From</option>
                                        @forelse ($locations as $location )
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <label for="">To</label>
                                    <select class="form-control" name="location_to" required data-toggle="select2">
                                        <option value="">Select From</option>
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
                                <label for=""> Transferred By </label>
                                <input type="text" class="form-control" step="any" required name="transferred_by">
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
                                                    <th style="width: 50%;">
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
                                <div class="col-lg-12 col-sm-12">
                                    <label for="" > Received By</label>
                                    <input type="text" class="form-control" step="any" required  name="received_by">
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div>
                                    <div class="table-responsive">
                                        <table class="table table-centered border table-nowrap mb-lg-0" id="itemList">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th style="width: 50%;">Product</th>
                                                    <th>Quantity</th>
                                                    {{-- <th>Price</th>
                                                    <th>Total</th> --}}
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
                                        <textarea name="remark" rows="5" class="form-control" placeholder="Remark..."></textarea>
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
                                                    <th scope="row">Total Quantity :</th>
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
</script>

<script>
     var i = 0;

      // Add an item
      function addList() {
        var item_id = $("#item_id").val();
        var quantity = $("#quantity").val();
        var unit = $("#unit").val();
        var item = $("#item_name").val();

        if(item_id != '' && quantity != 0){
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

                <td> <button class='remove btn btn-danger btn-sm' onclick="removeRow(this)" style="float:right;">
                    <i class='fa fa-trash'></i></button>
                </td>

                </i><input type='hidden' name='product_list[`+i+`][item_id]' value='`+item_id+`'>
                "<input type='hidden' name='product_list[`+i+`][item]' value='`+item+`'>

                "<input type='hidden' name='product_list[`+i+`][unit]' value='`+unit+`''>
                "<input class="tot" type='hidden' name='product_list[`+i+`][quantity]' value='`+quantity+`''>
            </tr>
         `;
         $("#itemList tbody").append(List);
          $("#item_id").val("");
          $("#item").val("");
          $("#quantity").val("");
          ++i;


          var subTotalList = document.getElementsByClassName('tot');
            var gsubtotal = 0;
            for (const element of subTotalList) {
                gsubtotal = gsubtotal + parseInt(element.value);
            }
            document.getElementById("all_total").innerHTML = gsubtotal.toLocaleString('en-US');
        }else{
            alert("Please Fill All Items Data First !");
        }
      }

      function removeRow(button) {
        // Get the parent <tr> element of the clicked button
        var row = button.parentNode.parentNode;

        // Remove the <tr> element from its parent (in this case, the <table>)
        row.parentNode.removeChild(row);
            var subTotalList = document.getElementsByClassName('tot');
            var gsubtotal = 0;
            for (const element of subTotalList) {
                gsubtotal = gsubtotal + parseInt(element.value);
            }
            document.getElementById("all_total").innerHTML = gsubtotal.toLocaleString('en-US');
        }


</script>

@endsection
