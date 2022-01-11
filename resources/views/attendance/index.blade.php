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
                            <h4>{{ __('Attendance') }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a>{{ auth()->user()->company->name }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Attendance') }}</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-end d-none d-sm-block">
                            <a data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-lg" class="btn btn-success">{{__('Add a new')}} {{__('Attendance')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="container-fluid">

            <div class="page-content-wrapper">


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">{{ __('Attendance') }}</h4>
                                <p class="card-title-desc">
                                    {{__('You can add and edit through this page')}}
                                </p>

                                <center>
                                    <div class="mb-4">
                                        <label class="form-label">Auto Close</label>
                                        <div class="input-group" id="datepicker2">
                                            <input type="text" class="form-control date2" placeholder="dd M, yyyy"
                                                data-date-format="dd M, yyyy" onchange="getData(this);" data-date-container='#datepicker2' data-provide="datepicker"
                                                data-date-autoclose="true">

                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div><!-- input-group -->
                                    </div>
                                </center>

                                <div class="row results">

                                </div>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    @include('layouts.footer')
</div>
@endsection




@section('script')
<script>

    function getData(ee){
        var date = $(ee).val();
        $.get(`/attendances/${date}`,function(e){
            e.forEach(element => {

                var start = 0;
                var end   = 0;

                if(element.attendance != null){
                    start = element.attendance.start;
                    end = element.attendance.end;
                }

                $('.results').append(`
                
                <div class="col-2 item01">
                    <img src="https://www.mcicon.com/wp-content/uploads/2021/01/People_User_1-copy-4.jpg" />
                    <div class="jp">${element.employee.job_number}</div>
                    <div class="employee_name ar">${element.employee.name_ar}</div>
                    <div class="employee_name en">${element.employee.name_en}</div>
                    <div class="time_in">
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
    <span class="input-group-btn input-group-prepend"></span>
    
    <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend"><span
            class="input-group-text"><i class="fas fa-sign-in-alt"></i></span></span><input id="demo2" type="time" value="${start}" onChange='updateTime(this, "start")' data-employee='${element.employee.id}' name="demo2"
        class="form-control" /><span class="input-group-btn input-group-append"></span>
</div>
                    </div>
                    <div class="time_out">
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
    <span class="input-group-btn input-group-prepend"></span>
    
    <span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend"><span
            class="input-group-text"><i class="fas fa-sign-out-alt"></i></span></span><input id="demo2" type="time" value="${end}" onChange='updateTime(this, "end")' data-employee='${element.employee.id}' name="demo2"
        class="form-control" /><span class="input-group-btn input-group-append"></span>
</div>
                    </div>
                </div>

                `);
            });
        });
    }

    function updateTime(ee,type){
        var timee = $(ee).val();
        var employee = $(ee).data('employee');
        var date = $(".date2").val();
        $.get('/update_attendances',{employee,timee,date,type},function(e){

        });
    }

</script>
<style>
    .item01 img{
        width: 80%;
        border-radius: 500px;
        border: 4px solid #9dd8e5;
        margin: auto;
        display: table;
    }
    .jp, .employee_name{
        text-align: center;
        font-size: 12px;
    }
    .item01 input{
        width: 100%;
    border: 0;
    }
</style>



@endsection

