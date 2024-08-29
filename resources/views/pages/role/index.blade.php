@extends('inc.frame')

@section('content')
@include('inc.message')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Roles</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="">Roles</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success px-3" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-white align-items-center">
                <div class="row">
                    <div class="col col-md-9 justify-content-start">
                        <h4 class="card-title ">Roles</h4>
                        <p class="card-category"> Here you can manage Roles</p>
                    </div>
                    <div class="col col-md-3 " style="text-align:right">

                        @can('role-create')
                            <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" style="border-radius: 20%;">
                                <i class="mdi mdi-plus"></i>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('pages.role.create')

                <div class="table-responsive">
                    <table class="table" id="basic-datatable">
                        <thead class=" text-primary">
                            <tr>
                                <th>
                                    Number
                                </th>
                                <th>
                                    Name
                                </th>
                                <th class="text-right" width="25%">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                              $i =1;
                            @endphp
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $i++ }}</td>

                                    <td>{{ $role->name }}</td>



                                    <td class="td-actions text-right" style="width:75px;overflow: hidden;">

                                        <div class="flex items-center space-x-4 text-sm">
                                            @can('role-edit')
                                                <a class="btn btn-primary"
                                                    href="editRole-{{$role->id }}">Edit</a>
                                            @endcan

                                            @can('role-delete')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}

                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

                                                {!! Form::close() !!}
                                            @endcan

                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>










                </div>
            </div>



        </div>

    </div>


</div>

@endsection
