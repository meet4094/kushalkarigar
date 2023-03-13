@extends('Admin.template')
@section('main-section')
    <style>
        .modal-dialog {
            max-width: 900px !important;
        }
    </style>
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Employer</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active" aria-current="page">Employer Profile View</li>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div>
                        <h6 class="card-title mb-0">Information</h6>
                    </div>
                </div>
                <div class="card-body text-center">
                    <div class="main-profile-overview widget-user-image text-center">
                        <div class="main-img-user"><img alt="avatar" src="{{ asset('assets/img/brand/users.png') }}">
                        </div>
                    </div>
                    <div class="item-user pro-user">
                        <h4 class="pro-user-username text-dark mt-2 mb-0">{{ $data->employer_name }}</h4>
                        <p class="pro-user-desc text-muted mb-1">{{ $data->designation }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="main-profile-contact-list main-profile-work-list">
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-smartphone"></i>
                            </div>
                            <div class="media-body">
                                <span>Mobile</span>
                                <div>
                                    {{ $data->phone_number }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-mail"></i>
                            </div>
                            <div class="media-body">
                                <span>Email ID</span>
                                <div>
                                    @sophia.w
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-map-pin"></i>
                            </div>
                            <div class="media-body">
                                <span>Current Address</span>
                                <div>
                                    {{ $data->latitude }}
                                    {{ $data->longitude }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div>
                        <h6 class="card-title mb-0">Hiring Details
                        </h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="main-profile-contact-list main-profile-work-list">
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-command"></i>
                            </div>
                            <div class="media-body">
                                <span>Categories Hiring</span>
                                <div>
                                    {{ $data->categories_hiring }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-cpu"></i>
                            </div>
                            <div class="media-body">
                                <span>Cities Hiring</span>
                                <div>
                                    {{ $data->cities_hiring }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-disc"></i>
                            </div>
                            <div class="media-body">
                                <span>Unit Hiring for</span>
                                <div>
                                    {{ $data->unit_hiring_for }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div>
                        <h6 class="card-title mb-0">Company Details
                        </h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="main-profile-contact-list main-profile-work-list">
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-user"></i>
                            </div>
                            <div class="media-body">
                                <span>Organization Name</span>
                                <div>
                                    {{ $data->organization_name }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-type"></i>
                            </div>
                            <div class="media-body">
                                <span>Organization Type</span>
                                <div>
                                    {{ $data->organization_type }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-mail"></i>
                            </div>
                            <div class="media-body">
                                <span>Organization email ID</span>
                                <div>
                                    {{ $data->organization_email_id }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-smartphone"></i>
                            </div>
                            <div class="media-body">
                                <span>GST number</span>
                                <div>
                                    {{ $data->gst_number }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-file"></i>
                            </div>
                            <div class="media-body">
                                <span>GST certificate</span>
                                <div>
                                    {{ $data->gst_certificate }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-map-pin"></i>
                            </div>
                            <div class="media-body">
                                <span>Organization headquarters</span>
                                <div>
                                    {{ $data->organization_headquarters }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-maximize-2"></i>
                            </div>
                            <div class="media-body">
                                <span>Organization size</span>
                                <div>
                                    {{ $data->organization_size }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-type"></i>
                            </div>
                            <div class="media-body">
                                <span>Product Type</span>
                                <div>
                                    {{ $data->product_type }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div>
                        <h6 class="card-title mb-0">Unit Details </h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="main-profile-contact-list main-profile-work-list">
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-user"></i>
                            </div>
                            <div class="media-body">
                                <span>Unit Name</span>
                                <div>
                                    {{ $data->unit_name }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-map-pin"></i>
                            </div>
                            <div class="media-body">
                                <span>Unit Address</span>
                                <div>
                                    {{ $data->unit_address }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-pocket"></i>
                            </div>
                            <div class="media-body">
                                <span>Unit POC Name</span>
                                <div>
                                    {{ $data->unit_poc_name }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-smartphone"></i>
                            </div>
                            <div class="media-body">
                                <span>Unit POC Contact Number</span>
                                <div>
                                    {{ $data->unit_poc_contact_number }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-mail"></i>
                            </div>
                            <div class="media-body">
                                <span>Unit POC email ID</span>
                                <div>
                                    {{ $data->unit_poc_email_id }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-globe"></i>
                            </div>
                            <div class="media-body">
                                <span>Unit GST number</span>
                                <div>
                                    {{ $data->unit_gst_number }}
                                </div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-logo bg-light text-dark">
                                <i class="fe fe-map-pin"></i>
                            </div>
                            <div class="media-body">
                                <span>Unit Location</span>
                                <div>
                                    {{ $data->unit_location_latitude }}
                                    {{ $data->unit_location_longitude }}
                                </div>
                            </div>
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
    </script>
@endsection
