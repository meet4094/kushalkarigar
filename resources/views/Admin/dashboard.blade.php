@extends('Admin.template')

@section('main-section')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Welcome To Dashboard</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kushal Karigar Dashboard</li>
            </ol>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card custom-card">
                <div class="card-body dash1">
                    <div class="d-flex">
                        <h3 class="dash-25 counter">{{ $employer_data }}</h3>
                        <div class="ml-auto">
                            <i class="fe fe-user fa-2x"></i>
                        </div>
                    </div>
                    <div class="expansion-label d-flex">
                        <span class="text-muted">Employer</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card custom-card">
                <div class="card-body dash1">
                    <div class="d-flex">
                        <h3 class="dash-25 counter">{{ $employee_data }}</h3>
                        <div class="ml-auto">
                            <i class="fa fa-users fa-2x"></i>
                        </div>
                    </div>
                    <div class="expansion-label d-flex">
                        <span class="text-muted">Employee</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card custom-card">
                <div class="card-body dash1">
                    <div class="d-flex">
                        <h3 class="dash-25 counter">{{ $jobs }}</h3>
                        <div class="ml-auto">
                            <i class="fa fa-tasks fa-2x"></i>
                        </div>
                    </div>
                    <div class="expansion-label d-flex text-muted">
                        <span class="text-muted">Job Of Type</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card custom-card">
                <div class="card-body dash1">
                    <div class="d-flex">
                        <h3 class="dash-25 counter">{{ $skills }}</h3>
                        <div class="ml-auto">
                            <i class="far fa-book fa-2x"></i>
                        </div>
                    </div>
                    <div class="expansion-label d-flex text-muted">
                        <span class="text-muted">Skil Set</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card custom-card">
                <div class="card-body dash1">
                    <div class="d-flex">
                        <h3 class="dash-25 counter">{{ $work_experiences }}</h3>
                        <div class="ml-auto">
                            <i class="fa fa-history fa-2x"></i>
                        </div>
                    </div>
                    <div class="expansion-label d-flex text-muted">
                        <span class="text-muted">Work Experience</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card custom-card">
                <div class="card-body dash1">
                    <div class="d-flex">
                        <h3 class="dash-25 counter">{{ $expected_salary_range }}</h3>
                        <div class="ml-auto">
                            <i class="far fa-dollar-sign fa-2x"></i>
                        </div>
                    </div>
                    <div class="expansion-label d-flex text-muted">
                        <span class="text-muted">Expected Salary Range</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.counter').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });

        });
    </script>
@endsection
