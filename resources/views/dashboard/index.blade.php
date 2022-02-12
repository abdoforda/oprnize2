@extends('layouts.app_auth')


@section('content')

<div class="main-content">

    <div class="page-content">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="page-title">
                            <h4>{{__('Dashboard')}}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a>{{ auth()->user()->company->name_en }}</a></li>
                                <li class="breadcrumb-item"><a>{{__('Dashboard')}}</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-end d-none d-sm-block">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="container-fluid">

            <div class="page-content-wrapper">


                <div class="row">
                    <div class="col-xl-4">
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <a href="/employee"><p class="font-size-16">{{ __('Employees') }}</p></a>
                                            <div class="mini-stat-icon mx-auto mb-4 mt-3">
                                                <span class="avatar-title rounded-circle bg-soft-success">
                                                    <i class="mdi mdi-account-outline text-success font-size-20"></i>
                                                </span>
                                            </div>
                                            <h5 class="font-size-22">{{ count(App\Employee::all()) }}</h5>

                                            <p class="text-muted">{{__('Usage rate')}} 80%</p>

                                            <div class="progress mt-3" style="height: 4px;">
                                                <div class="progress-bar progress-bar bg-success" role="progressbar"
                                                    style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                                                    aria-valuemax="80">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>

                </div>


            </div>


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('layouts.footer')
</div>
<!-- end main content-->

@endsection