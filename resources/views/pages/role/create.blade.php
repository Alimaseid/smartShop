<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div style="display: flex; justify-content: space-between;align-items:center">
                            <h4>Create Role</h4>
                            <a href="{{ route('roles.index') }}"><i class="fas fa-arrow-left"></i>
                                Back</a>
                        </div>
                    </div>


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


                    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}

                    <div class="row">

                        <div class="col-12">

                            <div class="form-group">
                                <label class="form-label" for="name">Name:</label>
                                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                <br />
                            </div>

                        </div>

                        <div class="col-12 mb-1">

                            <div class="form-group">
                                <label class="form-label" for="name">Permission:</label>
                                <br />
                                <div class="row">
                                    {{-- Organize permissions by role names --}}
                                    @php
                                        $permissionsByRole = [];

                                        foreach ($permission as $value) {
                                            $roleName = Str::before($value->name, '-');
                                            $permissionName = Str::after($value->name, '-');
                                            $permissionsByRole[$roleName][] = [
                                                'id' => $value->id,
                                                'name' => $permissionName,
                                            ];
                                        }
                                    @endphp

                                    @foreach ($permissionsByRole as $roleName => $permissions)
                                        <div class="col-md-3">
                                            {{ $roleName }} <br>
                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    <div class="col-md-12">
                                                        <label>{{ Form::checkbox('permission[]', $permission['id'], false, ['class' => 'name']) }}
                                                            {{ $permission['name'] }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>

                    </div>

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
</div>
