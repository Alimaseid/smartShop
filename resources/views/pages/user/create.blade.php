<div class="modal fade" id="scrollable-modal" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-body">

                    <div class="row">

                        <div class="col-lg-12 margin-tb">

                            <div class="pull-left">

                                <h2>Create User</h2>

                            </div>
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



                    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}

                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label class="mb-1">
                                    <strong>Name:</strong>
                                </label>

                                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}

                            </div>
                        </div>

                        <div class="col-12 mb-2">
                            <div class="form-group ">
                                <label class="mb-1">
                                    <strong>Email:</strong>
                                </label>

                                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}


                            </div>
                        </div>

                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label class="mb-1">
                                    <strong>Password:</strong>
                                </label>

                                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}


                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label class="mb-1">
                                    <strong>Confirm Password:</strong>
                                </label>

                                {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}


                            </div>
                        </div>

                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label class="mb-1">
                                    <strong>Role:</strong>
                                </label>

                                {!! Form::select('roles[]', $roles, [], ['class' => 'form-select']) !!}
                            </div>
                        </div>

                        <div class="col-12 text-center mb-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
