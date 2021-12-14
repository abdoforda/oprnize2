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
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-mail"></i>
                                <span>Email</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="email-inbox.html">Inbox</a></li>
                                <li><a href="email-read.html">Email Read</a></li>
                                <li><a href="email-compose.html">Email Compose</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">Components</li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-suitcase"></i>
                                <span>UI Elements</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="ui-alerts.html">Alerts</a></li>
                                <li><a href="ui-buttons.html">Buttons</a></li>
                                <li><a href="ui-cards.html">Cards</a></li>
                                <li><a href="ui-carousel.html">Carousel</a></li>
                                <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                                <li><a href="ui-grid.html">Grid</a></li>
                                <li><a href="ui-images.html">Images</a></li>
                                <li><a href="ui-lightbox.html">Lightbox</a></li>
                                <li><a href="ui-modals.html">Modals</a></li>
                                <li><a href="ui-rangeslider.html">Range Slider</a></li>
                                <li><a href="ui-session-timeout.html">Session Timeout</a></li>
                                <li><a href="ui-progressbars.html">Progress Bars</a></li>
                                <li><a href="ui-sweet-alert.html">Sweet-Alert</a></li>
                                <li><a href="ui-tabs-accordions.html">Accordions</a></li>
                                <li><a href="ui-typography.html">Typography</a></li>
                                <li><a href="ui-video.html">Video</a></li>
                                <li><a href="ui-general.html">General</a></li>
                                <li><a href="ui-colors.html">Colors</a></li>
                                <li><a href="ui-rating.html">Rating</a></li>
                            </ul>
                        </li>





                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="dripicons-to-do"></i>
                                <span class="badge rounded-pill bg-danger float-end">6</span>
                                <span>Forms</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="form-elements.html">Form Elements</a></li>
                                <li><a href="form-validation.html">Form Validation</a></li>
                                <li><a href="form-advanced.html">Form Advanced</a></li>
                                <li><a href="form-editors.html">Form Editors</a></li>
                                <li><a href="form-uploads.html">Form Upload</a></li>
                                <li><a href="form-xeditable.html">Form Xeditable</a></li>
                                <li><a href="form-wizard.html">Form Wizard</a></li>
                                <li><a href="form-mask.html">Form Mask</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-graph-pie"></i>
                                <span>Charts</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="charts-apex.html">Apex charts</a></li>
                                <li><a href="charts-chartist.html">Chartist</a></li>
                                <li><a href="charts-chartjs.html">Chartjs Chart</a></li>
                                <li><a href="charts-flot.html">Flot Chart</a></li>
                                <li><a href="charts-knob.html">Knob Chart</a></li>
                                <li><a href="charts-sparkline.html">Sparkline Chart</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-toggles"></i>
                                <span>Tables</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="tables-basic.html">Basic Tables</a></li>
                                <li><a href="tables-datatable.html">Data Tables</a></li>
                                <li><a href="tables-responsive.html">Responsive Table</a></li>
                                <li><a href="tables-editable.html">Editable Table</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-basket"></i>
                                <span>Icons</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="icons-materialdesign.html">Material Design</a></li>
                                <li><a href="icons-dripicons.html">Dripicons</a></li>
                                <li><a href="icons-fontawesome.html">Font awesome</a></li>
                                <li><a href="icons-themify.html">Themify Icons</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-map"></i>
                                <span>Maps</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="maps-google.html">Google Maps</a></li>
                                <li><a href="maps-vector.html">Vector Maps</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">Extras</li>


                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-device-desktop"></i>
                                <span>Layouts</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow">Vertical</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="layouts-dark-sidebar.html">Dark Sidebar</a></li>
                                        <li><a href="layouts-compact-sidebar.html">Compact Sidebar</a></li>
                                        <li><a href="layouts-icon-sidebar.html">Icon Sidebar</a></li>
                                        <li><a href="layouts-boxed.html">Boxed Layout</a></li>
                                        <li><a href="layouts-preloader.html">Preloader</a></li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript: void(0);" class="has-arrow">Horizontal</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="layouts-horizontal.html">Horizontal</a></li>
                                        <li><a href="layouts-hori-topbar-light.html">Topbar light</a></li>
                                        <li><a href="layouts-hori-boxed-width.html">Boxed width</a></li>
                                        <li><a href="layouts-hori-preloader.html">Preloader</a></li>
                                        <li><a href="layouts-hori-colored-header.html">Colored Header</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>



                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-user-group"></i>
                                <span>Authentication</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="auth-login.html">Login</a></li>
                                <li><a href="auth-register.html">Register</a></li>
                                <li><a href="auth-recoverpw.html">Re-Password</a></li>
                                <li><a href="auth-lock-screen.html">Lock Screen</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-copy"></i>
                                <span>Pages</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="pages-timeline.html">Timeline</a></li>
                                <li><a href="pages-invoice.html">Invoice</a></li>
                                <li><a href="pages-blank.html">Blank Page</a></li>
                                <li><a href="pages-404.html">Error 404</a></li>
                                <li><a href="pages-500.html">Error 500</a></li>
                                <li><a href="pages-pricing.html">Pricing</a></li>
                                <li><a href="pages-maintenance.html">Maintenance</a></li>
                                <li><a href="pages-comingsoon.html">Coming Soon</a></li>
                                <li><a href="pages-faq.html">FAQs</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="dripicons-checklist"></i>
                                <span>Multi Level</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);">Level 1.1</a></li>
                                <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>
                                    <ul class="sub-menu" aria-expanded="true">
                                        <li><a href="javascript: void(0);">Level 2.1</a></li>
                                        <li><a href="javascript: void(0);">Level 2.2</a></li>
                                    </ul>
                                </li>
                            </ul>
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