
@extends('inc.frame')

@section('content')
@include('inc.message')
{{-- <title>ERP-Inventory customers</title> --}}

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg">
                <i class="fa fa-plus-circle"> Customers</i>
             </button>
            </h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-customer"><a href="javascript: void(0);">ERP</a></li>
                    <li class="breadcrumb-customer"><a href="/">Inventory</a></li>
                    <li class="breadcrumb-customer active">Customers</li>
                </ol>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" style="font-size:12px" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Balance</th>
                            <th>Payment</th>
                            <th>_______</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 0; @endphp
                           @forelse ($customers as $customer)
                             @php $no = $no + 1; @endphp

                               <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->city }},{{ $customer->woreda }},{{ $customer->kebele }}</td>
                                <td>{{ number_format($customer->total_balance ,2)}}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#pay-{{ $customer->id }}">Pay</a>
                                </td>
                                <td style="width: 30%">
                                    <a href="customer-statement-{{ $customer->id }}" class="btn btn-success btn-sm"><i class="fa fa-folder"></i> Statment</a>
                                    <a href="customer_ledger-{{ $customer->id }}" class="btn btn-purple btn-sm"><i class="fa fa-folder"></i> Ledger</a>
                                    <a onclick="editcustomer({{ $customer }})" data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="customerDelete-{{ $customer->id }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                               </tr>

                               <div class="modal fade" id="pay-{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myLargeModalLabel">{{ $customer->name }}'s Payment</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form action="customerPay-{{ $customer->id }}" id="editForm" method="post" class="parsley-examples">
                                                                @csrf
                                                                <div class="row pb-2">
                                                                    <div class="col-lg-6">
                                                                        <label class="form-label">Date *</label>
                                                                        <input  type="date"  name="date" class="form-control" required value="{{ now()->toDateString() }}"/>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <label class="form-label">Payment Type</label>
                                                                        <select name="payment_type" required class="form-control"@required(true) id="">
                                                                            <option value="">Select</option>
                                                                            <option value="Cash">Cash</option>
                                                                            <option value="Check">Check</option>
                                                                            <option value="Bank Transfer">Bank Transfer</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row pb-2">
                                                                    <div class="col-lg-6">
                                                                        <label class="form-label">Paid Amount</label>
                                                                        <input  type="number" step="any"  name="amount"  class="form-control" placeholder="Paid Amount"/>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <label class="form-label">Check No/ Transfer Number </label>
                                                                        <input  type="text" name="check_or_transfer_id"  class="form-control" placeholder="Check No / Transfer Number"/>
                                                                    </div>
                                                                </div>
                                                                <div class="row pb-2">
                                                                    <div class="col-lg-12">
                                                                        <label class="form-label">Remarks</label>
                                                                        <textarea name="remarks" rows="4" class="form-control" placeholder="Remarks"></textarea>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="payment_no" value="MNP-{{ rand(1000000,9999999) }}" id="">


                                                                <div>
                                                                    <button type="submit" onclick="return alert('are you sure !.')" class="btn btn-primary waves-effect waves-light me-1">
                                                                        Pay
                                                                    </button>
                                                                    <button type="reset" class="btn btn-secondary waves-effect">
                                                                        Cancel
                                                                    </button>
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
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>



<div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">New customer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="customer" method="post" class="parsley-examples">
                                    @csrf
                                    <div class="row pb-2">
                                        <div class="col-lg-6">
                                            <label class="form-label">Name *</label>
                                            <input  type="text" name="name" class="form-control" required placeholder="customer Name"/>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-label">Company Name</label>
                                            <input  type="text" name="company_name" class="form-control" placeholder="Company Name"/>
                                        </div>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-lg-6">
                                            <label class="form-label">Email</label>
                                            <input  type="email" name="email" class="form-control" placeholder="Email"/>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-label">Phone Number *</label>
                                            <input type="text" name="phone" placeholder="Phone" class="form-control" pattern="[+ , 0]{1}[0-9]{9,14}" required>
                                        </div>
                                    </div>

                                    <div class="row pb-2">
                                        <div class="col-lg-6">
                                            <label class="form-label">City</label>
                                            <input  type="text" name="city" class="form-control" placeholder="City"/>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-label">Woreda</label>
                                            <input  type="text"  name="woreda" class="form-control"  placeholder="Woreda"/>
                                        </div>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-lg-6">
                                            <label class="form-label">Kebele</label>
                                            <input  type="text" name="kebele" class="form-control"  placeholder="Kebele"/>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label">Opning Balance</label>
                                            <input  type="number" step="any" id="opening-balance" value="0" name="opening_balance" class="form-control"  placeholder="Opening Balance"/>
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


{{-- edit customer --}}


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit customer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="editCustomer" method="post" class="parsley-examples">
                                    @csrf
                                    <div class="row pb-2">
                                        <div class="col-lg-6">
                                            <label class="form-label">Name *</label>
                                            <input  type="text" id="name" name="name" class="form-control" required placeholder="customer Name"/>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-label">Company Name</label>
                                            <input  type="text" id="company_name" name="company_name" class="form-control"  placeholder="Company Name"/>
                                        </div>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-lg-6">
                                            <label class="form-label">Email</label>
                                            <input  type="email" id="email" name="email" class="form-control" placeholder="Email"/>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-label">Phone Number *</label>
                                            <input type="text" id="phone" name="phone" placeholder="Phone" class="form-control" pattern="[+ , 0]{1}[0-9]{9,14}" required>
                                        </div>
                                    </div>

                                    <div class="row pb-2">
                                        <div class="col-lg-6">
                                            <label class="form-label">City</label>
                                            <input  type="text" id="city" name="city" class="form-control" placeholder="City"/>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-label">Woreda</label>
                                            <input  type="text" id="woreda" name="woreda" class="form-control"  placeholder="Woreda"/>
                                        </div>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-lg-6">
                                            <label class="form-label">Kebele</label>
                                            <input  type="text" id="kebele" id="kebele" name="kebele" class="form-control"  placeholder="Kebele"/>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label">Opning Balance</label>
                                            <input  type="number" step="any" readonly id="opening_balance" value="0" name="opening_balance" class="form-control"  placeholder="Opening Balance"/>
                                        </div>
                                    </div>

                                    <div>
                                        <div>
                                            <button type="submit" onclick="return alert('are you sure ! save change.')" class="btn btn-primary waves-effect waves-light me-1">
                                                Save Change
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



<script>
    function editcustomer(customer){
      var modal =  document.getElementById('edit');
      var form =  document.getElementById('editCustomer');
      form.action = 'customer/'+customer['id'];

      console.log(form);


      document.getElementById('name').value =customer['name'] ;
      document.getElementById('phone').value = customer['phone'];
      document.getElementById('email').value = customer['email'];
      document.getElementById('company_name').value = customer['company_name'];
      document.getElementById('city').value =customer['city'] ;
      document.getElementById('woreda').value = customer['woreda'];
      document.getElementById('kebele').value = customer['kebele'];

    }
</script>



@endsection
