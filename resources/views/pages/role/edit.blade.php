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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Roles</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card  rounded-3 px-3 ">
        <div class="card-header  bg-primary rounded-3 " style="margin-top: -10px;color:#fff">
            <div style="display: flex; justify-content: space-between;">
                <strong>Edit Role</strong>
                <a href="{{ route('roles.index') }}" class="text-white"><i class="fas fa-arrow-left"></i>
                    Back</a>
            </div>
        </div>

        <div class="card-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">

                    <strong>Whoops!</strong> There were some problems with your input.<br><br>

                    <ul>

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>
            @endif

            {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}

            @csrf
            <div class="row mt-3">
                <div class="">
                    <div class="form-group">

                        <label class="form-label">Name:</label>

                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                        <br />
                    </div>
                </div>

                <div class="form-group">

                    <label class="form-label">Permission:</label>

                    <br />


                    <div class="row">
                        @foreach ($permission as $value)
                            <div class="col-md-3">
                                <label>
                                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                    {{ $value->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>


            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection
