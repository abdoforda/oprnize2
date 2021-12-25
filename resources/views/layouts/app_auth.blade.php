<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (app()->getLocale() == "ar")
dir="rtl"
@else
dir="ltr"
@endif>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@500&display=swap" rel="stylesheet">

    @if (app()->getLocale() == "ar")
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap-rtl.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app-rtl.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @else
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @endif

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    @yield('style')
    @if (app()->getLocale() == "ar")
    <style>
        .dir01 {
            direction: rtl;
        }

        .checkbox2_item i {
            left: inherit;
            right: -4px;
        }
    </style>
    <script>
        var lang = "ar";
    </script>
    @else
    <script>
        var lang = "en";
    </script>
    @endif
</head>

<body>


    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">

                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="20">
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="20">
                            </span>
                        </a>
                    </div>


                </div>

                <!-- Search input -->
                <div class="search-wrap" id="search-wrap">
                    <div class="search-bar">
                        <input class="search-input form-control" placeholder="Search" />
                        <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                            <i class="mdi mdi-close-circle"></i>
                        </a>
                    </div>
                </div>

                <div class="d-flex">
                    <div class="dropdown d-none d-lg-inline-block">
                        <button type="button" class="btn header-item toggle-search noti-icon waves-effect"
                            data-target="#search-wrap">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                    </div>

                    <div class="dropdown d-none d-md-block ms-2">


                        @if (Session::has('locale') && Session::get('locale') == "ar")
                        <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img class="me-2" src="{{ asset('assets/images/flags/ar.jpg') }}" alt="Header Language" height="16">
                            العربية <span class="mdi mdi-chevron-down"></span>
                        </button>
                        @else
                        <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img class="me-2" src="{{ asset('assets/images/flags/us.jpg') }}" alt="Header Language" height="16">
                            English <span class="mdi mdi-chevron-down"></span>
                        </button>
                        @endif

                        <div class="dropdown-menu dropdown-menu-end">

                            @if (Session::has('locale') && Session::get('locale') == "ar")
                            <a href="/language/en" class="dropdown-item notify-item">
                                <img src="{{ asset('assets/images/flags/us.jpg') }}" alt="user-image" class="me-1" height="12">
                                <span class="align-middle"> English </span>
                            </a>
                            @else
                            <a href="/language/ar" class="dropdown-item notify-item">
                                <img src="{{ asset('assets/images/flags/ar.jpg') }}" alt="user-image" class="me-1" height="12">
                                <span class="align-middle"> العربية </span>
                            </a>
                            @endif

                        </div>
                    </div>






                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="mdi mdi-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/avatar-7.jpg') }}"
                                alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1">James</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-account-circle-outline font-size-16 align-middle me-1"></i>
                                Profile</a>
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-wallet-outline font-size-16 align-middle me-1"></i> My Wallet</a>
                            <a class="dropdown-item d-block" href="#"><span
                                    class="badge badge-success float-end">11</span><i
                                    class="mdi mdi-cog-outline font-size-16 align-middle me-1"></i> Settings</a>
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-lock-open-outline font-size-16 align-middle me-1"></i> Lock
                                screen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#"><i
                                    class="mdi mdi-power font-size-16 align-middle me-1 text-danger"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">


                <div class="user-sidebar text-center">
                    <div class="dropdown">
                        <div class="user-img">
                            <img src="{{ asset('assets/images/users/avatar-7.jpg') }}" alt="" class="rounded-circle">
                            <span class="avatar-online bg-success"></span>
                        </div>
                        <div class="user-info">
                            <h5 class="mt-3 font-size-16 text-white">James Raphael</h5>
                            <span class="font-size-13 text-white-50">Administrator</span>
                        </div>
                    </div>
                </div>



                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="index.html" class="waves-effect">
                                <i class="dripicons-home"></i><span
                                    class="badge rounded-pill bg-info float-end">3</span>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="/employee" class=" waves-effect">
                                <i class="dripicons-user-group"></i>
                                <span>{{__('Employees')}}</span>
                            </a>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-toggles"></i>
                                <span>{{ __('Company Settings') }}</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/nationality">{{ __('nationalities') }}</a></li>
                                <li><a href="/department">{{ __('Departments') }}
                                
                                    <i class="glyphicon glyphicon-remove"></i>
                                </a></li>
                                <li><a href="/section">{{ __('Sections') }}</a></li>
                                <li><a href="/job">{{ __('Jobs') }}</a></li>
                                <li><a href="/setting">{{ __('General Settings') }}</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="/vacation" class=" waves-effect">
                                <i class="dripicons-user-group"></i>
                                <span>{{__('Leave Types')}}</span>
                            </a>
                        </li>

                        <li>
                            <a href="/allowance" class=" waves-effect">
                                <i class="dripicons-user-group"></i>
                                <span>{{__('Allowances')}}</span>
                            </a>
                        </li>

                        <li>
                            <a href="/deduction" class=" waves-effect">
                                <i class="dripicons-user-group"></i>
                                <span>{{__('Deductions')}}</span>
                            </a>
                        </li>

                        <li>
                            <a href="/payroll" class=" waves-effect">
                                <i class="dripicons-user-group"></i>
                                <span>{{__('Payroll manager')}}</span>
                            </a>
                        </li>

                        

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        
        @yield('content')
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light show_errors" data-bs-toggle="modal"
        data-bs-target=".bs-example-modal-center" style="display: none">Modal demo</button>
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">{{__('Notes')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body massage_errors">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="//rawgit.com/ngryman/jquery.finger/v0.1.2/dist/jquery.finger.js"></script>

    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/jquery-countdown/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    
    <!-- Countdown js -->
    <script src="{{ asset('assets/js/pages/coming-soon.init.js') }}"></script>

    @yield('script')

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/ajax.form.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>


    
    @yield('script2')
    @yield('models')
    @if(session()->has('warning'))
    <script>
        toast_message("{{ __('Notes') }}","{!! session()->get('warning') !!}","{{ __('OK01') }}");
    </script>
    @endif
</body>

</html>