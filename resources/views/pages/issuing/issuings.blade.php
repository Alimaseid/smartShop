@extends('inc.frame')

@section('content')
    @include('inc.message')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">
                    <a class="btn btn-primary btn-sm" href="/new-issuing">
                        <i class="fa fa-plus-circle"> New Issuing </i></a>
                </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ERP</a></li>
                        <li class="breadcrumb-item"><a href="/">Inventory</a></li>
                        <li class="breadcrumb-item active">Issuings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" style="font-size:12px"
                        class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>IssuingNo#</th>
                                <th>IssueFrom</th>
                                <th>RequestedBy</th>
                                <th>ReceivedBy</th>
                                <th>TotQyt</th>
                                <th>Remarks</th>
                                <th>_______</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0; @endphp
                            @forelse ($issues as $issue)
                                @php $no = $no + 1; @endphp

                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $issue->date }}</td>
                                    <td>{{ $issue->issuing_no }}</td>
                                    <td>{{ $issue->store->name }}</td>
                                    <td>{{ $issue->requested_by }}</td>
                                    <td>{{ $issue->received_by }}</td>
                                    <td>{{ $issue->total_quantity }}</td>

                                    <td>{{ $issue->remarks }}</td>
                                    <td>
                                        <a href="issue-{{ $issue->id }}" class="btn btn-primary btn-sm"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="issueRemove-{{ $issue->id }}" class="btn btn-danger btn-sm"><i
                                                class="fa fa-trash"></i></a>
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
@endsection
