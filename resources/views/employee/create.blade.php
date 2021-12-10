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
                            <h4>{{ __('New Employee') }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a>{{ auth()->user()->company->name }}</a></li>
                                <li class="breadcrumb-item">{{ __('Employees') }}</li>
                                <li class="breadcrumb-item active">{{ __('New Employee') }}</li>
                            </ol>
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
                        <!-- Left sidebar -->
                        <div class="email-leftbar card">
                            
                            <h6 class="mt-4">Labels</h6>

                            <div class="mail-list mt-1">

                                    <a href="#"><i class="mdi mdi-star-outline  float-end"></i> {{__('Information')}} </a>
                                    <a href="#"><i class="mdi mdi-star-outline  float-end"></i> Theme Support </a>
                                    <a href="#"><i class="mdi mdi-star-outline  float-end"></i> Theme Support </a>
                                    <a href="#"><i class="mdi mdi-star-outline  float-end"></i> Theme Support </a>
                            
                                </div>

                        </div>
                        <!-- End Left sidebar -->

                        <!-- Right Sidebar -->
                        <div class="email-rightbar mb-3">


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title">{{__('Personal Data')}}</h4>
                                            <p class="card-title-desc">
                                                {{ __('The fildes in color') }} <code class="highlighter-rouge dir01">{{ __('red') }}</code> {{ __('are mandatory') }}
                                            </p>
                                            
                                            <form action="/employee" method="POST" class="needs-validation ajax_em_store" novalidate="">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="validationCustom01" class="form-label">{{__('Employee Name (AR)')}}</label>
                                                            <input type="text" class="form-control" id="validationCustom01" name="name_ar" required="">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="validationCustom02" class="form-label">{{__('Employee Name (EN)')}}</label>
                                                            <input type="text" class="form-control" id="validationCustom02" name="name_en" required="">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="validationCustom01" class="form-label">{{__('Type')}}</label>
                                                            <div class="row choosse-input" data-select="">
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ __('Male') }}</span>
                                                                    <input type="radio" class="hide" name="gender" value="male">
                                                                </label>
                            
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ __('Female') }}</span>
                                                                    <input type="radio" class="hide" name="gender" value="female">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="validationCustom01" class="form-label">{{__('Social status')}}</label>
                                                            <div class="row choosse-input" data-select="">
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ __('Married') }}</span>
                                                                    <input type="radio" class="hide" name="marital_status" value="married">
                                                                </label>
                            
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ __('Single') }}</span>
                                                                    <input type="radio" class="hide" name="marital_status" value="single">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="validationCustom01" class="form-label">{{__('Nationality')}}</label>
                                                        <div class="row checkbox2" style="display: flex;">
                                                        </div>
                                                        <div class="row choosse-input country02" data-select="">
                                                            @include('componentes.nationalitys', ['type'=>2])
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <br />
                                                <div class="row">
                                                    <h4 class="header-title">{{__('Personal Data')}}</h4>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="validationCustom01" class="form-label">{{__('Identification Number')}}</label>
                                                            <input type="text" class="form-control euhgiuerhgerg" id="validationCustom01" name="id_num" required="">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="validationCustom02" class="form-label">{{__('Release date')}}</label>
                                                            <div class="input-group" id="datepicker2">
                                                                <input type="text" class="form-control" name="id_issue_date" placeholder="yyyy-m-dd"
                                                                    data-date-format="yyyy-m-dd" data-date-container='#datepicker2' data-provide="datepicker"
                                                                    data-date-autoclose="true">
            
                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="validationCustom03" class="form-label">{{__('Expiry date')}}</label>
                                                            <div class="input-group" id="datepicker3">
                                                                <input type="text" class="form-control" name="id_expire_date" placeholder="yyyy-m-dd"
                                                                    data-date-format="yyyy-m-dd" data-date-container='#datepicker3' data-provide="datepicker"
                                                                    data-date-autoclose="true">
            
                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>
                                                </div>


                                                <br />
                                                <div class="row">
                                                    <h4 class="header-title">{{__('Passport data')}}</h4>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="validationCustom01" class="form-label">{{__('Passport number')}}</label>
                                                            <input type="text" class="form-control" id="validationCustom01" name="passport_num" required="">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="validationCustom02" class="form-label">{{__('Release date')}}</label>
                                                            <div class="input-group" id="datepicker4">
                                                                <input type="text" class="form-control" name="passport_issue_date" placeholder="yyyy-m-dd"
                                                                    data-date-format="yyyy-m-dd" data-date-container='#datepicker4' data-provide="datepicker"
                                                                    data-date-autoclose="true">
            
                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="validationCustom03" class="form-label">{{__('Expiry date')}}</label>
                                                            <div class="input-group" id="datepicker5">
                                                                <input type="text" class="form-control" name="passport_expire_date" placeholder="yyyy-m-dd"
                                                                    data-date-format="yyyy-m-dd" data-date-container='#datepicker5' data-provide="datepicker"
                                                                    data-date-autoclose="true">
            
                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>
                                                </div>


                                                <br />
                                                <div class="row">
                                                    <h4 class="header-title">{{__('Contact Data')}}</h4>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="validationCustom01" class="form-label">{{__('Mobile number')}}</label>
                                                            <input type="text" class="form-control" id="validationCustom01" name="phone" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="validationCustom01" class="form-label">{{__('Email')}}</label>
                                                            <input type="text" class="form-control" id="validationCustom01" name="email" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="validationCustom01" class="form-label">{{__('Password')}}</label>
                                                            <input type="password" class="form-control" id="validationCustom01" name="password" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="validationCustom01" class="form-label">{{__('confirm password')}}</label>
                                                            <input type="password" class="form-control" id="validationCustom01" name="password_confirmation" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <br />
                                                <div class="row">
                                                    <h4 class="header-title">{{__('Job data')}}</h4>
                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label  class="form-label">{{__('Job Number')}}</label>
                                                            <input type="text" class="form-control" id="validationCustom01" name="job_number" required="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">{{__('administration')}}</label>
                                                            <div class="row choosse-input" data-select="">
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ __('text01') }}</span>
                                                                    <input type="radio" class="hide"  value="male">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">{{__('Sections')}}</label>
                                                            <div class="row choosse-input" data-select="">
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ __('text01') }}</span>
                                                                    <input type="radio" class="hide" value="male">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">{{__('Job title')}}</label>
                                                            <div class="row choosse-input" data-select="">
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ __('test') }}</span>
                                                                    <input type="radio" class="hide" name="job_id" value="male">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                                <br />
                                                <div class="row">
                                                    <h4 class="header-title">{{__('Contract data')}}</h4>
                                                    
                                                    
                                                    

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">{{__('Type of Contract')}}</label>
                                                            <div class="row choosse-input" data-select="">
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ __('limited time') }}</span>
                                                                    <input type="radio" class="hide" name="contract_type" value="limited">
                                                                </label>
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ __('unlimited time') }}</span>
                                                                    <input type="radio" class="hide" name="contract_type" value="unlimited">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">{{__('Employment type')}}</label>
                                                            <div class="row choosse-input" data-select="">
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ __('Full time') }}</span>
                                                                    <input type="radio" class="hide" name="employment_type" value="full_time">
                                                                </label>
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ __('Part time') }}</span>
                                                                    <input type="radio" class="hide" name="gender" value="part_time">
                                                                </label>
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ __('Seasonal') }}</span>
                                                                    <input type="radio" class="hide" name="gender" value="seasonal">
                                                                </label>
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ __('Temporary') }}</span>
                                                                    <input type="radio" class="hide" name="gender" value="temporary">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label  class="form-label">{{__('Contract Start Date')}}</label>
                                                            <div class="input-group" id="datepicker8">
                                                                <input type="text" class="form-control" name="contract_start_date" placeholder="yyyy-m-dd"
                                                                    data-date-format="yyyy-m-dd" data-date-container='#datepicker8' data-provide="datepicker"
                                                                    data-date-autoclose="true">
            
                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label  class="form-label">{{__('Contract End Date')}}</label>
                                                            <div class="input-group" id="datepicker9">
                                                                <input type="text" class="form-control" name="contract_end_date" placeholder="yyyy-m-dd"
                                                                    data-date-format="yyyy-m-dd" data-date-container='#datepicker9' data-provide="datepicker"
                                                                    data-date-autoclose="true">
            
                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>



                                                </div>


                                                <br />
                                                <div class="row">
                                                    <h4 class="header-title">{{__('Annual balance')}}</h4>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="row choosse-input" data-select="">
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>21</span>
                                                                    <input type="radio" class="hide" name="annual_balance" value="21">
                                                                </label>
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>30</span>
                                                                    <input type="radio" class="hide" name="annual_balance" value="30">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                
                                                <br />
                                                <div class="row">
                                                    <h4 class="header-title">{{__('Salary Data')}}</h4>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label  class="form-label">{{__('Salary Data')}}</label>
                                                            <input type="text" class="form-control" id="validationCustom01" name="salary" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-success waves-effect waves-light">Success</button>
                                                    </div>
                                                </div>


                                                

                                            </form>

                                            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                        </div>
                        <!-- card -->

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
        $(document).ready(function(e) {
            $(".ajax_em_store").ajaxForm({
                complete: function(data){
                    var mess = '';
                    if(data.status == 422){
                        for(let x in data.responseJSON.errors){
                            mess += "<p>"+data.responseJSON.errors[x][0]+"</p>";
                        }
                        $(".massage_errors").hide(0).html(mess).fadeIn();
                        $(".show_errors").trigger('click');
                    }else if(data.status == 200){
                        Success("{{__('Saved Ok')}}");
                    }
                    
                }
            });
        });
    </script>
@endsection