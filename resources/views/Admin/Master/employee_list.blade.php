@extends('Admin.template')
@section('main-section')
<style>
    .modal-dialog {
        max-width: 700px !important;
    }
</style>
<div class="page-header">
    <div>
        <h2 class="main-content-title tx-24 mg-b-5">Employees</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Master</li>
            <li class="breadcrumb-item active" aria-current="page">Employee List</li>
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
                    <form action="{{ url ('edit_employee') }}" class="ajax-form-submit" id="cform" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="employee_id" id="employee_id" value="">
                        <div class="modal-body">
                            <div class="row" style="display: flex;justify-content: center;">
                                <div class="col-12">
                                    <div class="">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="float-left" for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                                                        <span class="float-left tx-danger error_text name_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="float-left" for="email_id">Email</label>
                                                        <input type="text" class="form-control" id="email_id" name="email_id" placeholder="Enter Email">
                                                        <span class="float-left tx-danger error_text email_id_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="float-left" for="phone_number">Mobile No.</label>
                                                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter Mobile" required>
                                                        <span class="float-left tx-danger error_text phone_number_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="float-left" for="required_job">Required Job</label>
                                                        <input type="text" class="form-control" id="required_job" name="required_job" placeholder="Enter job" required>
                                                        <span class="float-left tx-danger error_text required_job_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="float-left" for="skill_set">Skill Set</label>
                                                        <input type="text" class="form-control" id="skill_set" name="skill_set" placeholder="Enter Skill" required>
                                                        <span class="float-left tx-danger error_text skill_set_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="float-left" for="work_experience">Work Experience</label>
                                                        <input type="text" class="form-control" id="work_experience" name="work_experience" placeholder="Enter job" required>
                                                        <span class="float-left tx-danger error_text work_experience_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 text-left">
                                                    <label class="" for="cname">Gender<span class="tx-danger">*</span></label>
                                                    <div class="form-control form-group">
                                                        <div class="form-check form-check-inline float-left">
                                                            <input class="form-check-input" type="radio" name="visible" id="visible1" value="Male" />
                                                            <label class="form-check-label" for="visible1">Male</label>
                                                        </div>
                                                        <div class="form-check form-check-inline float-left">
                                                            <input class="form-check-input" type="radio" name="visible" id="visible2" value="Female" />
                                                            <label class="form-check-label" for="visible2">Female</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="float-left" for="age">Age</label>
                                                        <input type="text" class="form-control" id="age" name="age" placeholder="Enter age">
                                                        <span class="float-left tx-danger error_text age_error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="float-left" for="education">Education</label>
                                                        <input type="text" class="form-control" id="education" name="education" placeholder="Enter job">
                                                        <span class="float-left tx-danger error_text education_error"></span>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="float-left" for="job_name">Documents</label>
                                                        <input type="text" class="form-control" id="job_name" name="job_name" placeholder="Enter job">
                                                        <span class="float-left tx-danger error_text job_name_error"></span>
                                                    </div>
                                                </div> -->
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label class="float-left" for="type_of_employement">Type of Employement</label>
                                                        <input type="text" class="form-control" id="type_of_employement" name="type_of_employement" placeholder="Enter job">
                                                        <span class="float-left tx-danger error_text type_of_employement_error"></span>
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
                            <button class="btn btn-primary" id="save_data" type="submit" value="Submit">Submit</button>
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
                        <table class="table data-table table-striped table-hover table-fw-widget" id="table_list_data" width="100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Employee Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'phone_number',
                    name: 'phone_number'
                },
                {
                    data: 'email_id',
                    name: 'email_id'
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

    function editable_block(block) {
        var type = 'Block';
        var data_val = $(block).data('val');
        var ot_title = $(block).attr('title');
        var employee_id = $(block).data('id');
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
                    url: "{{ url ('block_employee') }}",
                    type: 'post',
                    data: {
                        type: type,
                        data_val: data_val,
                        employee_id: employee_id
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
                        $('span.' + prefix + '_error').text(val).show().delay(5000).fadeOut();
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

    function edit_employee(edit_employee) {
        var employee_id = $(edit_employee).data('val');
        $.ajax({
            type: 'POST',
            url: "{{ url ('GetEmployeeData') }}",
            data: {
                employee_id: employee_id
            },
            success: function(response) {
                console.log(response);
                if (response.st == 'success') {
                    $('.modal-title').html('Edit Employee');
                    $('#employee_id').val(response.msg.id);
                    $('#name').val(response.msg.name);
                    $('#email_id').val(response.msg.email_id);
                    $('#phone_number').val(response.msg.phone_number);
                    $('#required_job').val(response.msg.type_of_job_required);
                    $('#skill_set').val(response.msg.skill_set);
                    $('#work_experience').val(response.msg.work_experience);
                    var gender = response.msg.gender;
                    var capGender = gender[0].toUpperCase() + gender.substring(1).toLowerCase();
                    if (capGender == 'Male') {
                        $('#visible1').prop("checked", true);
                    } else {
                        $('#visible2').prop("checked", true);
                    }
                    $('#edit_emp_modal').modal('show');
                    $('#age').val(response.msg.age);
                    $('#education').val(response.msg.education);
                    $('#type_of_employement').val(response.msg.type_of_employement);
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

    function editable_remove(data_edit) {
        var type = 'Remove';
        var employee_id = $(data_edit).data('val');
        var ot_title = $(data_edit).attr('title');
        Swal.fire({
            title: 'Are you sure want to delete employee : ' + ot_title + ' ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "{{ url ('deleteEmployee') }}",
                    type: 'post',
                    data: {
                        employee_id: employee_id
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