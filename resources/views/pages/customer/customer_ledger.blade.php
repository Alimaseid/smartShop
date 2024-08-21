@extends('inc.frame')

@section('content')

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Invoice</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                                <li class="breadcrumb-item"><a href="/customer">Customers</a></li>
                                <li class="breadcrumb-item active">Ledgers</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-2">
                            <!-- Logo & title -->
                            <a href="javascript:window.print()" style="float: right;" class="btn btn-primary waves-effect waves-light me-1 d-print-none"><i class="mdi mdi-printer me-1"></i> Print</a>

                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <h5>{{ $customer->name }}</h5>
                                    <address>
                                        Currunt Balance<br>
                                        <i><b style="color: black">{{ number_format($customer->total_balance,2)  }}</b></i><br>
                                    </address>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table mt-4 table-centered">
                                            <thead>
                                            <tr><th style="width: 2%">#</th>
                                                <th style="width: 10%">Date</th>
                                                <th style="width: 16%">IN</th>
                                                <th style="width: 16%">OUT</th>
                                                <th style="width: 19%">Balance</th>
                                                <th class="">Remark</th>
                                            </tr></thead>
                                            <tbody>
                                              @php $no = 1 ; $in = 0 ;  $out = 0 ;  @endphp
                                              @forelse ($ledgers as $ledger)
                                                <tr>
                                                    <td>{{ $no }}</td>
                                                    <td>{{ $ledger->created_at->format('d/m/y') }}</td>
                                                    <td>{{number_format( $ledger->in,2) }}</td>
                                                    <td>

                                                            {{number_format( $ledger->out,2)}}
                                                        </a>
                                                    </td>
                                                    <td>{{number_format( $ledger->current_balance,2) }}</td>
                                                    <td>
                                                        @if ($ledger->sales_id)
                                                            @forelse ($ledger->sales->details as $detail)
                                                                {{ $detail->item->name }} ({{ $detail->quantity}} * {{ $detail->unit_price}})<br />
                                                            @empty

                                                            @endforelse
                                                        @elseif ($ledger->payment)
                                                        {{$ledger->payment->payment_type}} Payment,
                                                         {{$ledger->payment->check_or_transfer_id}} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                         <a href="#" data-bs-toggle="modal" data-bs-target="#editPayment-{{ $ledger->payment->id }}"
                                                           style="@media" >
                                                            <i class="fa fa-edit"></i>
                                                         </a>


                                                        @endif


                                                    </td>
                                                </tr>
                                              @php $no = $no + 1 ; $in = $in + $ledger->in ; $out = $out + $ledger->out ;  @endphp



                                              @empty

                                              @endforelse

                                            </tbody>
                                        </table>
                                    </div> <!-- end table-responsive -->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="clearfix pt-5">
                                        <h6 class="text-muted">Generated By:</h6>

                                        <small class="text-muted">
                                            Minber ERP Inventory Sub System Module Version 1.0.1
                                        </small>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="float-end">
                                        <p><b>total in :</b> <span class="float-end">{{ number_format($in,2) }}</span></p>
                                        <p><b>total out :</b> <span class="float-end"> &nbsp;&nbsp;&nbsp; {{ number_format($out,2) }}</span></p>
                                        <h3>{{ number_format($customer->total_balance,2) }} Birr</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->


                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>


            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    @forelse ($ledgers as $ledger)
    @if ($ledger->payment)
       <div class="modal fade" id="editPayment-{{ $ledger->payment->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">{{ $ledger->payment->name }}'s Payment</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="editCustomerPay-{{ $ledger->payment->id }}" id="editForm" method="post" class="parsley-examples">
                                        @csrf
                                        <div class="row pb-2">
                                            <div class="col-lg-6">
                                                <label class="form-label">Date *</label>
                                                <input  type="date"  name="date" class="form-control" required value="{{ now()->toDateString() }}"/>
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="form-label">Payment Type</label>
                                                <select name="payment_type" required class="form-control" id="">
                                                    <option value="{{ $ledger->payment->payment_type }}">Select</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Check">Check</option>
                                                    <option value="Bank Transfer">Bank Transfer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row pb-2">
                                            <div class="col-lg-6">
                                                <label class="form-label">Paid Amount</label>
                                                <input  type="number" step="any"  name="amount"  class="form-control" value="{{ $ledger->payment->amount }}" />
                                            </div>

                                            <div class="col-lg-6">
                                                <label class="form-label">Check No/ Transfer Number </label>
                                                <input  type="text" name="check_or_transfer_id"  class="form-control"value="{{ $ledger->payment->check_or_transfer_id }}" />
                                            </div>
                                        </div>
                                        <div class="row pb-2">
                                            <div class="col-lg-12">
                                                <label class="form-label">Remarks</label>
                                                <textarea name="remarks" rows="4" class="form-control" placeholder="Remarks">{{ $ledger->payment->remarks }}</textarea>
                                            </div>
                                        </div>


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
    @endif
    @empty
    @endforelse

@endsection
