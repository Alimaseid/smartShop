@extends('inc.frame')

@section('content')
@include('inc.message')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Users</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/dashboard">dashboard</a></li>
                        <li class="breadcrumb-item"><a href="">Users</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



        <div class="row">


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
                                <h4 class="card-title ">Users</h4>
                                <p class="card-category"> Here you can manage users</p>
                            </div>
                            <div class="col col-md-3 " style="text-align:right">

                                <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                    data-bs-target="#scrollable-modal" style="border-radius: 20%;">
                                    <i class="mdi mdi-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        @include('pages.user.create')
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
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Roles
                                        </th>
                                        <th class="text-right" width="25%">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($data as $key => $user)
                                        <tr>
                                            <td>{{ $i++ }}</td>

                                            <td>{{ $user->name }}</td>

                                            <td>{{ $user->email }}</td>
                                            <td>

                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $v)
                                                        <label >{{ $v }}</label>
                                                    @endforeach
                                                @endif

                                            </td>


                                            <td class="td-actions text-right">
                                                <div class="flex items-center space-x-4 text-sm">

                                                    @can('user-edit')
                                                        <a class="btn btn-primary"
                                                            href="edituser-{{$user->id}}">Edit</a>
                                                    @endcan

                                                    @can('user-delete')
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}

                                                        {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}

                                                        {!! Form::close() !!}
                                                    @endcan

                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{-- {!! $data->render() !!} --}}

                        </div>
                    </div>
                </div>

            </div>
        </div>

</div>

@endsection
