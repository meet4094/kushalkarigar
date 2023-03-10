@extends('Admin.template')
@section('main-section')
    <style>
        .modal-dialog {
            max-width: 900px !important;
        }
    </style>
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Employee</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active" aria-current="page">Employee Profile View</li>
            </ol>
        </div>
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <div class="main-profile-overview widget-user-image text-center">
                        <div class="main-img-user"><img alt="avatar" src="{{ $data['self_picture'] }}"></div>
                    </div>
                    <div class="item-user pro-user">
                        <h4 class="pro-user-username text-dark mt-2 mb-0">{{ $data['name'] }}</h4>
                        <p class="pro-user-desc text-muted mb-1"></p>
                    </div>
                </div>
                <div class="card-footer p-0">
                    <div class="row text-center">
                        <div class="col-sm-6 border-right">
                            <div class="description-block">
                                <h5 class="description-header mb-1">Age</h5>
                                <span class="text-muted">{{ $data['age'] }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="description-block">
                                <h5 class="description-header mb-1">Gender</h5>
                                <span class="text-muted">{{ $data['gender'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card custom-card">
                <div class="card-header custom-card-header">
                    <div>
                        <h6 class="card-title mb-0">Contact Information</h6>
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
                                    {{ $data['phone_number'] }}
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
                                    {{ $data['email_id'] }}
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
                                    {{ $data['latitude'] }}
                                    {{ $data['longitude'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card custom-card main-content-body-profile">
                <nav class="nav main-nav-line">
                    <a class="nav-link active" data-toggle="tab" href="#tab1over">Overview</a>
                </nav>
                <div class="card-body tab-content h-100">
                    <div class="tab-pane active" id="tab1over">
                        <div class="row">
                            <div class="col-lg-12 col-xl-6">
                                <div class="card custom-card">
                                    <div class="card-header custom-card-header">
                                        <div>
                                            <h6 class="card-title mb-0">Type of Job Required</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="skill-tags">
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($data['type_of_job_required'] as $item)
                                                    <li><a href="#"
                                                            style="text-decoration: none;">{{ $item->job_name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card custom-card">
                                    <div class="card-header custom-card-header">
                                        <div>
                                            <h6 class="card-title mb-0">Skills</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="skill-tags">
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($data['skill_set'] as $item)
                                                    <li><a href="#"
                                                            style="text-decoration: none;">{{ $item->skill_name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card custom-card">
                                    <div class="card-header custom-card-header">
                                        <div>
                                            <h6 class="card-title mb-0">Work</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="skill-tags">
                                            <ul class="list-unstyled mb-0">
                                                <li><a
                                                        href="#"style="text-decoration: none;">{{ $data['experience'] }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card custom-card">
                                    <div class="card-header custom-card-header">
                                        <div>
                                            <h6 class="card-title mb-0">Education</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="skill-tags">
                                            <ul class="list-unstyled mb-0">
                                                <li><a
                                                        href="#"style="text-decoration: none;">{{ $data['education'] }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card custom-card">
                                    <div class="card-header custom-card-header">
                                        <div>
                                            <h6 class="card-title mb-0">Type of employement</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="skill-tags">
                                            <ul class="list-unstyled mb-0">
                                                <li><a
                                                        href="#"style="text-decoration: none;">{{ $data['type_of_employement'] }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="card custom-card">
                                    <div class="card-header custom-card-header">
                                        <div>
                                            <h6 class="card-title mb-0">Expected Salary Range</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="skill-tags">
                                            <ul class="list-unstyled mb-0">
                                                <li><a
                                                        href="#"style="text-decoration: none;">{{ $data['expected_salary_range'] }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-content-label tx-13 mg-b-20 mt-3">
                            Documents
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-3">
                                <img alt="Documents image" class="img-thumbnail" src="../../assets/img/media/1.jpg">
                            </div>
                            <div class="col-6 col-md-3">
                                <img alt="Documents image" class="img-thumbnail" src="../../assets/img/media/2.jpg">
                            </div>
                            <div class="col-6 col-md-3 mg-t-10 mg-sm-t-0">
                                <img alt="Documents image" class="img-thumbnail" src="../../assets/img/media/3.jpg">
                            </div>
                            <div class="col-6 col-md-3 mg-t-10 mg-sm-t-0">
                                <img alt="Documents image" class="img-thumbnail" src="../../assets/img/media/4.jpg">
                            </div>
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
