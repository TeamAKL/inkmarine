@extends('layouts.master')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <button type="button" class="btn btn-success " data-toggle="modal" data-target="#certificate-modal">
                Create Certificate
            </button>
        </div>
        <div class="card-body">
            <div class="container">
                <table id="certificate" class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-right"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="certificate-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Certificate Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form >
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Certificate Name">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create-certificate" data-dismiss="modal">Save</button>
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

        $("#create-certificate").on("click", function(e) {
            e.preventDefault();
            var title = $("#title").val();
            $.ajax({
                type: "POST",
                url: "{{url('certificate')}}",
                data: {
                    'title': title,
                    'id': id
                },
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(result) {
                    clearForm();
                    getAllCertificate();
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        /**
         * GET ALL CERTIFICATE
         */
         getAllCertificate();
         function getAllCertificate() {
            $("#certificate").DataTable({
                "lengthChange": true,
                "info": false,
                "searching": true,
                processing: true,
                serverSide: false,
                "destroy": true,
                "ordering": true,
                "ajax": {
                    "type": "POST",
                    "url": "{{ url('api/get-all-certificate') }}",
                    "headers": {
                        'Authorization': 'Bearer '+ token
                    },
                    "error": function (xhr, textStatus, error ) {
                        handleAjaxError(xhr, textStatus, error,redirect_url);
                    }
                },
                columns: [
                {data: 'title', name: 'title', orderable: true, searchable: true, 'width': '80%'},
                {data: 'action', name: 'action', searchable: false, orderable: false, 'width': '20%'}
                ]
            }).on('click', '.edit-btn', function(e) {
                var title = $(this).data('title');
                id = $(this).data('id');
                $("#title").val(title);
            }).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var certificate_id = $(this).data('id');

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
                            url: "{{url('/api/certificate-delete')}}",
                            data: {
                                'id': certificate_id
                            },
                            "headers": {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            success: function(result) {
                                getAllCertificate();
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
            $("#title").val("");
            id = null;
        }

        $('#certificate-modal').on('hidden.bs.modal', function (e) {
            clearForm();
        });
    });
</script>
@endpush