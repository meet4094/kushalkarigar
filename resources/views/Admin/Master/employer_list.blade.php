@extends('Admin.template')
@section('main-section')
    <style>
        .modal-dialog {
            max-width: 900px !important;
        }
    </style>
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Employers</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active" aria-current="page">Employer List</li>
            </ol>
        </div>
        <div class="btn btn-list">
            <div id="edit_emp_modal" class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('edit_employer') }}" class="ajax-form-submit" id="cform" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="employer_id" id="employer_id" value="">
                            <div class="modal-body">
                                <div class="row" style="display: flex;justify-content: center;">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="employer_name">Employer
                                                                Name</label>
                                                            <input type="text" class="form-control" id="employer_name"
                                                                name="employer_name" placeholder="Enter Employer Name"
                                                                required>
                                                            <span
                                                                class="float-left tx-danger error_text employer_name_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="phone_number">Mobile No.</label>
                                                            <input type="text" class="form-control" id="phone_number"
                                                                name="phone_number" placeholder="Enter Mobile" required>
                                                            <span
                                                                class="float-left tx-danger error_text phone_number_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="designation">Designation</label>
                                                            <input type="text" class="form-control" id="designation"
                                                                name="designation" placeholder="Enter Email">
                                                            <span
                                                                class="float-left tx-danger error_text designation_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="organization_name">Organization
                                                                Name</label>
                                                            <input type="text" class="form-control"
                                                                id="organization_name" name="organization_name"
                                                                placeholder="Enter Email">
                                                            <span
                                                                class="float-left tx-danger error_text organization_name_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="organization_type">Organization
                                                                Type</label>
                                                            <input type="text" class="form-control"
                                                                id="organization_type" name="organization_type"
                                                                placeholder="Enter Email">
                                                            <span
                                                                class="float-left tx-danger error_text organization_type_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left"
                                                                for="organization_email_id">Organization Email ID</label>
                                                            <input type="text" class="form-control"
                                                                id="organization_email_id" name="organization_email_id"
                                                                placeholder="Enter Email">
                                                            <span
                                                                class="float-left tx-danger error_text organization_email_id_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left"
                                                                for="organization_headquarters">Organization
                                                                Headquarters</label>
                                                            <input type="text" class="form-control"
                                                                id="organization_headquarters"
                                                                name="organization_headquarters"
                                                                placeholder="Enter Email">
                                                            <span
                                                                class="float-left tx-danger error_text organization_headquarters_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="organization_size">Organization
                                                                Size</label>
                                                            <input type="text" class="form-control"
                                                                id="organization_size" name="organization_size"
                                                                placeholder="Enter Email">
                                                            <span
                                                                class="float-left tx-danger error_text organization_size_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="gst_number">GST Number</label>
                                                            <input type="text" class="form-control" id="gst_number"
                                                                name="gst_number" placeholder="Enter job" required>
                                                            <span
                                                                class="float-left tx-danger error_text gst_number_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="gst_certificate">GST
                                                                Certificate</label>
                                                            <input type="text" class="form-control"
                                                                id="gst_certificate" name="gst_certificate"
                                                                placeholder="Enter Skill" required>
                                                            <span
                                                                class="float-left tx-danger error_text gst_certificate_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="product_type">Product
                                                                Type</label>
                                                            <input type="text" class="form-control" id="product_type"
                                                                name="product_type" placeholder="Enter job" required>
                                                            <span
                                                                class="float-left tx-danger error_text product_type_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="categories_hiring">Categories
                                                                Hiring</label>
                                                            <input type="text" class="form-control"
                                                                id="categories_hiring" name="categories_hiring"
                                                                placeholder="Enter job" required>
                                                            <span
                                                                class="float-left tx-danger error_text categories_hiring_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="cities_hiring">Cities
                                                                Hiring</label>
                                                            <input type="text" class="form-control" id="cities_hiring"
                                                                name="cities_hiring" placeholder="Enter job" required>
                                                            <span
                                                                class="float-left tx-danger error_text cities_hiring_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="unit_hiring_for">Unit Hiring
                                                                For</label>
                                                            <input type="text" class="form-control"
                                                                id="unit_hiring_for" name="unit_hiring_for"
                                                                placeholder="Enter job" required>
                                                            <span
                                                                class="float-left tx-danger error_text unit_hiring_for_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="unit_name">Unit Name</label>
                                                            <input type="text" class="form-control" id="unit_name"
                                                                name="unit_name" placeholder="Enter job" required>
                                                            <span
                                                                class="float-left tx-danger error_text unit_name_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="unit_address">Unit
                                                                Address</label>
                                                            <input type="text" class="form-control" id="unit_address"
                                                                name="unit_address" placeholder="Enter job" required>
                                                            <span
                                                                class="float-left tx-danger error_text unit_address_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="unit_poc_name">Unit Poc
                                                                Name</label>
                                                            <input type="text" class="form-control" id="unit_poc_name"
                                                                name="unit_poc_name" placeholder="Enter job" required>
                                                            <span
                                                                class="float-left tx-danger error_text unit_poc_name_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="unit_poc_contact_number">Unit
                                                                Poc Contact
                                                                Number</label>
                                                            <input type="text" class="form-control"
                                                                id="unit_poc_contact_number"
                                                                name="unit_poc_contact_number" placeholder="Enter job"
                                                                required>
                                                            <span
                                                                class="float-left tx-danger error_text unit_poc_contact_number_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="unit_poc_email_id">Unit Poc
                                                                Email ID</label>
                                                            <input type="text" class="form-control"
                                                                id="unit_poc_email_id" name="unit_poc_email_id"
                                                                placeholder="Enter job" required>
                                                            <span
                                                                class="float-left tx-danger error_text unit_poc_email_id_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="unit_gst_number">Unit Gst
                                                                Number</label>
                                                            <input type="text" class="form-control"
                                                                id="unit_gst_number" name="unit_gst_number"
                                                                placeholder="Enter job" required>
                                                            <span
                                                                class="float-left tx-danger error_text unit_gst_number_error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="float-left" for="unit_location">Unit
                                                                Location</label>
                                                            <input type="text" class="form-control" id="unit_location"
                                                                name="unit_location" placeholder="Enter job" required>
                                                            <span
                                                                class="float-left tx-danger error_text unit_location_error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="error-msg tx-danger"></div>
                                        <div class="form_proccessing tx-success float-left"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" id="save_data" type="submit"
                                    value="Submit">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-header-divider">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table table-striped table-hover table-fw-widget" id="table_list_data"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Employer Name</th>
                                        <th>Mobile</th>
                                        <th>Block</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            load_data();
        });

        function load_data(filter_data = '') {
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    data: {
                        data: filter_data,
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'employer_name',
                        name: 'employer_name'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'is_block',
                        name: 'is_block',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        }

        function edit_employer(edit_employer) {
            var employer_id = $(edit_employer).data('val');
            $.ajax({
                type: 'POST',
                url: "{{ url('GetEmployerData') }}",
                data: {
                    employer_id: employer_id
                },
                success: function(response) {
                    console.log(response);
                    if (response.st == 'success') {
                        $('#edit_emp_modal').modal('show');
                        $('.modal-title').html('Edit Employer');
                        $('#employer_id').val(response.msg.id);
                        $('#employer_name').val(response.msg.employer_name);
                        $('#designation').val(response.msg.designation);
                        $('#organization_name').val(response.msg.organization_name);
                        $('#organization_type').val(response.msg.organization_type);
                        $('#organization_email_id').val(response.msg.organization_email_id);
                        $('#organization_headquarters').val(response.msg.organization_headquarters);
                        $('#organization_size').val(response.msg.organization_size);
                        $('#phone_number').val(response.msg.phone_number);
                        $('#gst_number').val(response.msg.gst_number);
                        $('#gst_certificate').val(response.msg.gst_certificate);
                        $('#product_type').val(response.msg.product_type);
                        $('#categories_hiring').val(response.msg.categories_hiring);
                        $('#cities_hiring').val(response.msg.cities_hiring);
                        $('#unit_hiring_for').val(response.msg.unit_hiring_for);
                        $('#unit_name').val(response.msg.unit_name);
                        $('#unit_address').val(response.msg.unit_address);
                        $('#unit_poc_name').val(response.msg.unit_poc_name);
                        $('#unit_poc_contact_number').val(response.msg.unit_poc_contact_number);
                        $('#unit_poc_email_id').val(response.msg.unit_poc_email_id);
                        $('#unit_gst_number').val(response.msg.unit_gst_number);
                        $('#unit_location').val(response.msg.unit_location);
                    } else {
                        alert('failed');
                    }
                },
                error: function(error) {
                    $('#save_data').prop('disabled', false);
                    alert('Error');
                }
            });
        }


        $('.ajax-form-submit').on('submit', function(e) {
            $('#save_data').prop('disabled', true);
            $('.error-msg').html('');
            $('.form_proccessing').html('Please wait...');
            e.preventDefault();
            var aurl = $(this).attr('action');
            var form = $(this);
            var formdata = false;
            if (window.FormData) {
                formdata = new FormData(form[0]);
            }
            $.ajax({
                type: "POST",
                url: aurl,
                cache: false,
                contentType: false,
                processData: false,
                data: formdata ? formdata : form.serialize(),
                success: function(response) {
                    if (response.st == 'success') {
                        $('#edit_emp_modal').modal('toggle');
                        $('.form_proccessing').html('');
                        $('#save_data').prop('disabled', false);
                        Swal.fire("Success!", response.msg, "success");
                        $('.data-table').DataTable().ajax.reload();
                    } else {
                        $('.form_proccessing').html('');
                        $('#save_data').prop('disabled', false);
                        $.each(response.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val).show().delay(5000)
                                .fadeOut();
                        });
                    }
                },
                error: function() {
                    $('#save_data').prop('disabled', false);
                    alert('Error');
                }
            });
            return false;
        });

        function editable_block(block) {
            var type = 'Block';
            var data_val = $(block).data('val');
            var ot_title = $(block).attr('title');
            var employer_id = $(block).data('id');
            if (data_val == 0) {
                var title = 'Are you sure want to Block ' + ot_title + ' ?'
                var btn = 'Block'
            }
            if (data_val == 1) {
                var title = 'Are you sure want to Unblock ' + ot_title + ' ?'
                var btn = 'Unblock'
            }
            Swal.fire({
                title: title,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ' + btn + ' it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('block_employer') }}",
                        type: 'post',
                        data: {
                            type: type,
                            data_val: data_val,
                            employer_id: employer_id
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.success == 1) {
                                Swal.fire(response.title, response.msg, 'success')
                                $('.data-table').DataTable().ajax.reload();
                            } else {
                                alert("Failed");
                            }
                        }
                    });
                }
            })
        }

        function editable_remove(data_edit) {
            var type = 'Remove';
            var employer_id = $(data_edit).data('val');
            var ot_title = $(data_edit).attr('title');
            Swal.fire({
                title: 'Are you sure want to delete employer : ' + ot_title + ' ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('deleteEmployer') }}",
                        type: 'post',
                        data: {
                            employer_id: employer_id
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your data has been deleted.',
                                    'success'
                                )
                                $('.data-table').DataTable().ajax.reload();
                            } else {
                                alert("Failed");
                            }
                        }
                    });
                } else {
                    swal.fire("Cancelled", "Your data is safe", "error");

                }
            })
        }
    </script>
@endsection
