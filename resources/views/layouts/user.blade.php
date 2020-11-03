@extends('layouts.master')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <button type="button" class="btn btn-success " data-toggle="modal" data-target="#user-modal">
                Add User
            </button>
        </div>
        <div class="card-body">
            <div class="container">
                <table id="users" class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            {{-- <th>Password</th> --}}
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Crate User Modal -->
<div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Certificate Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create-user" >Create</button>
            </div>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="reset-password-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset Password Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id">
                <div class="form-group row">
                    <label for="respassword" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                    <div class="col-md-6">
                        <input id="respassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="respassword-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="respassword-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="reset-password" >Reset</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var token = "{{ env('MIX_APP_TOKEN')}}";

        // Clear Create Fomr
        function clearCreateFomr() {
            $("#email").val("");
            $("#name").val("");
            $("#password").val("");
            $("#password-confirm").val("");
        }

        function clearResetForm() {
            $("#id").val("");
            $("#respassword").val("");
            $("#respassword-confirm").val("");
        }


        //Reset Password
        $("#reset-password").on('click', function(e) {
            e.preventDefault();
            var that = $(this);
            var id = $("#id").val();
            var rspassword = $("#respassword").val();
            var rspassword_confirm = $("#respassword-confirm").val();
            if(rspassword == '' || rspassword_confirm == '') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please fill required fields',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else if (rspassword_confirm != rspassword) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Password and Confirm Password does not match',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: "{{url('/api/reset-password')}}",
                    data: {
                        'id': id,
                        'password': rspassword
                    },
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function(result) {
                        $('#reset-password-modal').modal('hide')
                        getusers();
                        clearResetForm();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        })

        // Create User
        $("#create-user").on('click', function(e) {
            e.preventDefault();
            var email = $("#email").val();
            var name = $("#name").val();
            var password = $("#password").val();
            var password_confirm = $("#password-confirm").val();
            if(email != '' && name != '' && password == password_confirm && password_confirm != '' && password != '') {
                $.ajax({
                    type: "POST",
                    url: "{{url('/api/create-user')}}",
                    data: {
                        'name': name,
                        'email': email,
                        'password': password
                    },
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function(result) {
                        $('#user-modal').modal('hide')
                        getusers();
                        clearCreateFomr();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            } else if(password != password_confirm) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Password and Confirm Password does not match',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Please fill required fields',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });

        // Get Users
        getusers();
        function getusers() {
            $("#users").DataTable({
                "lengthChange": true,
                "info": false,
                "searching": true,
                processing: true,
                serverSide: false,
                "destroy": true,
                "ordering": true,
                "ajax": {
                    "type": "POST",
                    "url": "{{ url('api/get-users') }}",
                    "headers": {
                        'Authorization': 'Bearer '+ token
                    },
                    "error": function (xhr, textStatus, error ) {
                        handleAjaxError(xhr, textStatus, error,redirect_url);
                    }
                },
                columns: [
                {data: 'name', name: 'name', orderable: true, searchable: true, 'width': '30%'},
                {data: 'email', name: 'email', orderable: true, searchable: true, 'width': '40%'},
                {data: 'action', name: 'action', searchable: false, orderable: false, 'width': '30%'}
                ]
            }).on('click', '.reset-btn', function() {
                $('#reset-password-modal #id').val($(this).data('id'));
            }).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Want to delete " + name,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{url('/api/delete-user')}}",
                            data: {
                                'id': id,
                            },
                            "headers": {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            success: function(result) {
                                getusers();
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        });
                    }
                });
            });
        }
    });
</script>
@endpush
