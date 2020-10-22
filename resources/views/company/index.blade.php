@extends('layouts.master')
@section('content')

  <div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <button type="button" class="btn btn-success " data-toggle="modal" data-target="#company-modal">
                Add New Company
            </button>
        </div>
        <div class="card-body">
            <div class="container">
                <table id="company" class="table">
                    <thead>
                        <tr>
                            <th>COMPANY NAME</th>
                            <th>COUNTRY</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="company-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Company Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form >
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Company Name :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="country" class="col-sm-4 col-form-label">Country :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create-company" data-dismiss="modal">Save</button>
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
        var id = null;

        $("#create-company").on("click", function(e) {
            e.preventDefault();
            var name = $("#name").val();
            var country = $("#country").val();
            $.ajax({
                type: "POST",
                url: "{{url('company')}}",
                data: {
                    'name': name,
                    'country': country,
                    'id': id
                },
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(result) {
                    clearForm();
                    getAllCompany();
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        /**
         * GET ALL Company
         */
         getAllCompany();
         function getAllCompany() {
            $("#company").DataTable({
                "lengthChange": true,
                "info": false,
                "searching": true,
                processing: true,
                serverSide: false,
                "destroy": true,
                "ordering": true,
                "ajax": {
                    "type": "POST",
                    "url": "{{ url('api/get-all-company') }}",
                    "headers": {
                        'Authorization': 'Bearer '+ token
                    },
                    "error": function (xhr, textStatus, error ) {
                        handleAjaxError(xhr, textStatus, error,redirect_url);
                    }
                },
                columns: [
                {data: 'name', name: 'name', orderable: true, searchable: true, 'width': '40%'},
                {data: 'country', name: 'country', orderable: true, searchable: true, 'width': '40%'},
                {data: 'action', name: 'action', searchable: false, orderable: false, 'width': '20%'}
                ]
            }).on('click', '.edit-btn', function(e) {
                var name = $(this).data('name');
                var country = $(this).data('country');
                var id = $(this).data('id');
                $("#name").val(name);
                $("#country").val(country);
            }).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var company_id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Want to delete this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{url('/api/company-delete')}}",
                            data: {
                                'id': company_id
                            },
                            "headers": {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            success: function(result) {
                                getAllCompany();
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        });
                    }
                });
            });
        }

        function clearForm() {
            $("#name").val("");
            $("#country").val("");
            id = null;
        }

        $('#company-modal').on('hidden.bs.modal', function (e) {
            clearForm();
        });
    });
</script>
@endpush