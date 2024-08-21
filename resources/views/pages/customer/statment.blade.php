<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $customer->name }}'s Statment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css">

    <style>
        body{
            font-family: 'Times New Roman', Times, serif;
        }
        .my-container{
            padding-top:2%;
            padding-left:4%;
            padding-bottom:4%;
            width: 80%;
            margin: 0 auto;
        }
        .header{
            padding: 10px;
            width: 100%;

        }

        @media print{
            body {
                margin: 0; /* Reset margins */
                width: 100% !important;
            }
            /* Ensure the page width is full */
            .my-container {
                width: 100% !important;
                margin: 0 !important;
                padding: 0% !important;
            }
          #btn{
            display: none;
          }

        }
    </style>
</head>
<body>
      <div class="my-container">
        <div class="row">
            <div class="col-2">
                <div class="row">
                  <a href="customer" id="btn"  class="btn btn-dark p-2"> Back </i></a>
                </div>
            </div>
            <div class="col-8">
                <form action="getCustomerStatementByDate-{{ $customer->id }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-2">
                        </div>
                        <div class="col-lg-7">
                            <input id="btn" class="form-control input-daterange-datepicker" type="text" name="daterange"/>
                        </div>
                        <div class="col-lg-2">
                            <button id="btn" class="btn btn-dark">Go</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2">
                <div class="row">
                    <button id="btn"  class="btn btn-dark p-2"  onclick="printStatement()"> Print <i class="fa fa-edit" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="row p-2">
                <div class="col-4">
                 <b  onclick="printStatement()">{{ $customer->name }}</b>
                </div>
                <div class="col-4">
                </div>
                <div class="col-4">
                  <b> <u style="float: right">Date: @php $date ? print($date) : print('Until - '.now()->format('M-d,Y') ) @endphp</u> </b>
                </div>

            </div>
            <div class="row p-2">
                <div class="col-4">
                    <Address>
                      {{-- <span>To:</span><b style="float: right"> </b> --}}
                      {{-- <br> --}}
                      <span>City: </span> <i style="float: right"> {{ $customer->city }}</i>
                      <br>
                      <span>Woerda,Kebele:</span> <i style="float: right">{{ $customer->woreda }}, {{ $customer->kebele }}</i>
                      <br>
                      <span>Phone: </span> <i style="float: right"> {{ $customer->phone }}</i>
                    </Address>
                </div>
                <div class="col-3">
                     <center>
                    <img src="https://th.bing.com/th/id/R.ecc4b812ac1ea33459536978508eda8c?rik=7m4%2bwuvHVF40ZQ&pid=ImgRaw&r=0" height="50px" width="50px" alt="">
                    {{-- <hr> --}}
                     </center>
                </div>

                <div class="col-5 balance">
                  <Address>
                    <span  style="float: left">Total Service Amount: </span> <i><b style="float: right">{{ number_format($out,2) }}</b></i>
                    <br>
                    <span>Total Paid Amount: </span> <i><b style="float: right"> {{ number_format($in,2) }}</b></i>
                    <br>
                    <span>Currunt Balance: </span> <i><b style="float: right">{{number_format($customer->total_balance,2) }}</b></i>
                 </Address>
                </div>
            </div>
        </div>
        <div class="content">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Transaction</th>
                    <th scope="col">Amount</th>
                    <th scope="col text-sm">Tax %</th>
                    <th scope="col text-sm">Discount %</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody>
                    @php $no = 0; @endphp
                  @forelse ($ledgers as $ledger)
                  @php $no = $no + 1; @endphp
                  <tr>
                    <th scope="row">{{ $no }}</th>
                    <td style="width: 10%;">{{ $ledger->created_at->format('d/m/y') }}</td>
                    @if ($ledger->in == null)
                      <td> Sales &nbsp; &nbsp; # {{ $ledger->sales->invoice_no }}</td>
                      <td>{{ number_format( $ledger->sales->sub_total,2) }}</td>
                      <td>{{ $ledger->sales->vat }} </td>
                      <td>{{ $ledger->sales->discount }}</td>
                      <td>{{number_format( $ledger->sales->total,2) }}</td>
                    @else
                      <td> Payment  &nbsp; &nbsp; # {{ $ledger->payment->payment_no }}</td>
                      <td> {{ number_format($ledger->payment->amount,2) }}</td>
                      <td> 0 </td>
                      <td> 0 </td>
                      <td> {{ number_format($ledger->payment->amount,2) }}</td>

                    @endif
                  </tr>
                  @empty
                  @endforelse
                </tbody>
              </table>
        </div>
        <div class="sammury">


                <div class="row p-2">
                    <div class="col-4">
                        <img src="https://th.bing.com/th/id/R.ecc4b812ac1ea33459536978508eda8c?rik=7m4%2bwuvHVF40ZQ&pid=ImgRaw&r=0" height="100px" width="100px" alt="">
                    </div>
                    <div class="col-3">
                         <address>
                         </address>
                    </div>

                    <div class="col-5">
                      <Address>
                        <span  style="float: left">Total Service Amount: </span> <i><b style="float: right">{{ number_format($out,2) }}</b></i>
                        <br>
                        <span>Total Paid Amount: </span> <i><b style="float: right"> {{ number_format($in,2) }}</b></i>
                        <br>
                        <span>Currunt Balance: </span> <b style="float: right"> {{ number_format($customer->total_balance,2) }}</b>
                     </Address>
                    </div>
                </div>

        </div>
        {{-- <div class="row">
            <div class="col-6">
                <div class="row">
                  <a href="customer" id="btn"  class="btn btn-dark p-2"> Back </i></a>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <button id="btn"  class="btn btn-dark p-2"  onclick="printStatement()"> Print <i class="fa fa-print"></i></button>
                </div>
            </div>
        </div> --}}
        <hr>
      </div>


      <script>
          function printStatement() {
            window.print();
          }
      </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="assets/js/vendor.min.js"></script>

<!-- Plugins js-->
<script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/moment/min/moment.min.js"></script>
<script src="assets/libs/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Init js-->
<script src="assets/js/pages/form-pickers.init.js"></script>

<!-- App js -->
<script src="assets/js/app.min.js"></script>
</body>
</html>



