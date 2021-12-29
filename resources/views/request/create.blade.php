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
                            <h4>{{ __('Create order') }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a>{{ auth()->user()->company->name }}</a></li>
                                <li class="breadcrumb-item">{{ __('Requests') }}</li>
                                <li class="breadcrumb-item active">{{ __('Create order') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="container-fluid">

            <div class="page-content-wrapper" id="html01">




                <div class="row">
                    <div class="col-12">
                       
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">{{ __('Create order') }}</h4>
                                <p class="card-title-desc">
                                    {{ __('Choose one of these requests and complete the rest of the procedures') }}
                                </p>

                                
                                <button onclick="request_type('leave')" type="button" class="btn btn-outline-secondary waves-effect waves-light">طلب أجازة</button>

                                <button type="button" class="btn btn-outline-secondary waves-effect waves-light">عمل إضافي</button>

                            </div>
                        </div>

                    </div>
                    <!-- end Col-9 -->

                </div>
                <!-- End row -->

            </div>


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('layouts.footer')
</div>
<!-- end main content-->

@endsection

@section('script')
    <script>
        function request_type(typee){
            $("#html01").fadeOut(500);
            $.get('/view',{typee},function(e){
                setTimeout(() => {
                    $("#html01").hide().html(e).fadeIn();
                }, 510);
            });
        }


    </script>
@endsection