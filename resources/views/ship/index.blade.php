@extends('layouts.master')
@section('content')
   
  <div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <button type="button" class="btn btn-success " data-toggle="modal" data-target="#ship-modal">
                Add New Ship
            </button>
        </div>
        <div class="card-body">
            <div class="container">
                <table id="ship" class="table">
                    <thead>
                        <tr>
                          <th>SHIP NAME</th>
                          <th>SHIP TYPE</th>
                          <th>COMPANY</th>
                          <th>GRT</th>
                          <th>KW</th>
                          <th>AREA</th>
                          <th class="text-right"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ship-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ship Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form >
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Ship Name :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Ship Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-4 col-form-label">Ship Type :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="type" name="type" placeholder="Enter Ship Type">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company" class="col-sm-4 col-form-label">Company :</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="company" name="company">
                              <option value="0" selected>Select</option>
                            @foreach($companies as $company)
                              <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="grt" class="col-sm-4 col-form-label">GRT :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="grt" name="grt" placeholder="Enter GRT">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kw" class="col-sm-4 col-form-label">KW :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="kw" name="kw" placeholder="Enter KW">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="area" class="col-sm-4 col-form-label">AREA :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="area" name="area" placeholder="Enter Country">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create-ship" data-dismiss="modal">Save</button>
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

        $("#create-ship").on("click", function(e) {
            e.preventDefault();
            var name = $("#name").val();
            var type = $("#type").val();
            var company = $("#company").val();
            var grt = $("#grt").val();
            var kw = $("#kw").val();
            var area = $("#area").val();
            $.ajax({
                type: "POST",
                url: "{{url('ship')}}",
                data: {
                    'name': name,
                    'type': type,
                    'company': company,
                    'grt': grt,
                    'kw': kw,
                    'area': area,
                    'id': id
                },
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(result) {
                    clearForm();
                    getAllShip();
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        /**
         * GET ALL Ship
         */
         getAllShip();
         function getAllShip() {
            $("#ship").DataTable({
                "lengthChange": true,
                "info": false,
                "searching": true,
                processing: true,
                serverSide: false,
                "destroy": true,
                "ordering": true,
                "ajax": {
                    "type": "POST",
                    "url": "{{ url('api/get-all-ship') }}",
                    "headers": {
                        'Authorization': 'Bearer '+ token
                    },
                    "error": function (xhr, textStatus, error ) {
                        handleAjaxError(xhr, textStatus, error,redirect_url);
                    }
                },
                columns: [
                {data: 'ship_name', name: 'name', orderable: true, searchable: true, 'width': '14%'},
                {data: 'ship_type', name: 'country', orderable: true, searchable: true, 'width': '14%'},
                {data: 'name', name: 'name', orderable: true, searchable: true, 'width': '14%'},
                {data: 'grt', name: 'grt', orderable: true, searchable: true, 'width': '14%'},
                {data: 'kw', name: 'kw', orderable: true, searchable: true, 'width': '14%'},
                {data: 'area', name: 'area', orderable: true, searchable: true, 'width': '14%'},
                {data: 'action', name: 'action', searchable: false, orderable: false, 'width': '16%'}
                ]
            }).on('click', '.edit-btn', function(e) {
                var ship_name = $(this).data('shipname');
                var type = $(this).data('type');
                var company = $(this).data('company');
                var grt = $(this).data('grt');
                var kw = $(this).data('kw');
                var area = $(this).data('area');
                var id = $(this).data('id');
                $("#name").val(ship_name);
                $("#type").val(type);
                $("#company").val(company);
                $("#grt").val(grt);
                $("#kw").val(kw);
                $("#area").val(area);
            }).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var ship_id = $(this).data('id');

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
                            url: "{{url('/api/ship-delete')}}",
                            data: {
                                'id': ship_id
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
            $("#type").val("");
            $("#company").val("");
            $("#grt").val("");
            $("#kw").val("");
            $("#area").val("");

            id = null;
        }

        $('#ship-modal').on('hidden.bs.modal', function (e) {
            clearForm();
        });
    });
</script>
@endpush