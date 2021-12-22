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
                                                            <input type="text" class="form-control" id="validationCustom01" name="name_ar" @isset($em) value="{{ $em->name_ar }}" @endisset required="">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="validationCustom02" class="form-label">{{__('Employee Name (EN)')}}</label>
                                                            <input type="text" class="form-control" id="validationCustom02" name="name_en" @isset($em) value="{{ $em->name_en }}" @endisset required="">
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
                                                            <div class="row choosse-input" @isset($em) data-select="{{ $em->gender }}" @endisset >
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
                                                            <div class="row choosse-input" @isset($em) data-select="{{ $em->marital_status }}" @endisset>
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
                                                        <div class="row choosse-input country02" @isset($em) data-select="{{ $em->nationality_id }}" @endisset>
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
                                                            <input type="text" class="form-control euhgiuerhgerg" id="validationCustom01" @isset($em) value="{{ $em->id_num }}" @endisset name="id_num" required="">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="validationCustom02" class="form-label">{{__('Release date')}}</label>
                                                            <div class="input-group" id="datepicker2">
                                                                <input type="text" class="form-control" name="id_issue_date" @isset($em) value="{{ $em->id_issue_date }}" @endisset placeholder="yyyy-m-dd"
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
                                                                <input type="text" class="form-control" @isset($em) value="{{ $em->id_expire_date }}" @endisset name="id_expire_date" placeholder="yyyy-m-dd"
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
                                                            <input type="text" class="form-control" id="validationCustom01" @isset($em) value="{{ $em->passport_num }}" @endisset name="passport_num" required="">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="validationCustom02" class="form-label">{{__('Release date')}}</label>
                                                            <div class="input-group" id="datepicker4">
                                                                <input type="text" class="form-control" name="passport_issue_date" @isset($em) value="{{ $em->passport_issue_date }}" @endisset placeholder="yyyy-m-dd"
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
                                                                <input type="text" class="form-control" name="passport_expire_date" @isset($em) value="{{ $em->passport_expire_date }}" @endisset placeholder="yyyy-m-dd"
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
                                                            <input type="text" class="form-control" id="validationCustom01" name="job_number" @isset($em) value="{{ $em->job_number }}" @endisset required="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">{{__('administration')}}</label>
                                                            <div class="row choosse-input" @isset($em) data-select="{{ $em->department_id }}" @endisset>

                                                                @foreach ($company->departments as $department)
                                                                    <label class="choosse" onclick="gotosection({{ $department->id }});">
                                                                        <i class="fas fa-check-circle"></i>
                                                                        <span>{{ $department->name }}</span>
                                                                        <input type="radio" class="hide" name="department_id" value="{{ $department->id }}">
                                                                    </label>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">{{__('Sections')}}</label>
                                                            <div class="row choosse-input section2" @isset($em) data-select="{{ $em->section_id }}" @endisset>
                                                                @isset($sections)
                                                                    @foreach ($sections as $item)
                                                                    <label class="choosse" onclick="gotojob({{ $item->id }});">
                                                                        <i class="fas fa-check-circle"></i>
                                                                        <span>{{ $item->name }}</span>
                                                                        <input type="radio" class="hide" name="section_id" value="{{ $item->id }}">
                                                                    </label>
                                                                    @endforeach
                                                                @endisset
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">{{__('Job title')}}</label>
                                                            <div class="row choosse-input add_job2" @isset($em) data-select="{{ $em->job_id }}" @endisset>
                                                                @isset($jobs)
                                                                @foreach ($jobs as $item)
                                                                <label class="choosse">
                                                                    <i class="fas fa-check-circle"></i>
                                                                    <span>{{ $item->name }}</span>
                                                                    <input type="radio" class="hide" name="job_id" value="{{ $item->id }}">
                                                                </label>
                                                                @endforeach
                                                            @endisset
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
                                                            <div class="row choosse-input" @isset($em) data-select="{{ $em->contract_type }}" @endisset >
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
                                                            <div class="row choosse-input"  @isset($em) data-select="{{ $em->employment_type }}" @endisset >
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
                                                                <input type="text" class="form-control" @isset($em) value="{{ $em->contract_start_date }}" @endisset name="contract_start_date" placeholder="yyyy-m-dd"
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
                                                                <input type="text" class="form-control" @isset($em) value="{{ $em->contract_end_date }}" @endisset name="contract_end_date" placeholder="yyyy-m-dd"
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
                                                            <div class="row choosse-input" @isset($em) data-select="{{ $em->id_num }}" @endisset >
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
                                                            <input type="text" class="form-control" id="validationCustom01" @isset($em) value="{{ $em->salary }}" @endisset name="salary" required="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <br />
                                                <div class="row" style="padding: 4px; background: #f5f5f5; border-radius: 8px">
                                                    <h4 class="header-title">{{__('Allowances')}}</h4>
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col"><input class="form-control" type="text" disabled  placeholder="بدل السكن"></div>
                                                            <div class="col"><input class="form-control" type="text" disabled  placeholder="HRA"></div>
                                                            <div class="col"><input class="form-control" type="number" @isset($em) value="{{ $em->hra_value }}" @endisset name="hra_value" placeholder="{{ __('Value in riyals') }}"></div>
                                                            <div class="col"><input class="form-control" type="number" @isset($em) value="{{ $em->hra_percentage }}" @endisset name="hra_percentage" placeholder="{{ __('value as a percentage') }}"></div>
                                                        </div>
                                                    </div><br /><br /><br />
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col"><input class="form-control" type="text" disabled  placeholder="بدل المواصلات"></div>
                                                            <div class="col"><input class="form-control" type="text"  disabled placeholder="Trans"></div>
                                                            <div class="col"><input class="form-control" type="number" @isset($em) value="{{ $em->trans_value }}" @endisset name="trans_value" placeholder="{{ __('Value in riyals') }}"></div>
                                                            <div class="col"><input class="form-control" type="number" @isset($em) value="{{ $em->trans_percentage }}" @endisset name="trans_percentage" placeholder="{{ __('value as a percentage') }}"></div>
                                                        </div>
                                                    </div><br /><br /><br />
                                                    <div class="allowances_items">
                                                        
                                                    </div>
                                                    
                                                    <br />
                                                    <br />
                                                    <div class="col-md-12">
                                                        <button type="button" onclick="add_allow()" class="btn btn-secondary btn-sm btn-block waves-effect waves-light mt-0">{{ __('Add a new allowance') }}</button>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('Save') }}</button>
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
                    else if(data.status == 201){
                        Success("{{__('Saved Ok')}}");
                        window.location.href = '/employee';
                    }
                    
                }
            });
        });



        function add_allow(){
            var html = `<div class="col-md-12">
                            <div class="row">
                                <div class="col"><input class="form-control" type="text" name="allowance_name_ar[]" placeholder="{{ __('Name (AR)') }}"></div>
                                <div class="col"><input class="form-control" type="text" name="allowance_name_en[]" placeholder="{{ __('Name (EN)') }}"></div>
                                <div class="col"><input class="form-control" type="text" name="allowance_value[]" placeholder="{{ __('Value in riyals') }}"></div>
                                <div class="col"><input class="form-control" type="text" name="allowance_percentage[]" placeholder="{{ __('value as a percentage') }}"></div>
                            </div>
                        </div><br />`;

            $(".allowances_items").append(html);

        }

        var c = 0;
        function gotosection(section){
            $(".section2").html('').hide(0);
            $(".add_job2").html('').hide(0);
            if(c == 0){
                $.get('/get_sections_from_department_id',{section},function(e){
                    e.forEach(add_section);
                    $(".section2").fadeIn();
                });
                c = 1;
            }
            setTimeout(() => {
                c = 0;
            }, 100);
        }

        function add_section(i){
            $(".section2").append(`<label class="choosse" onclick="gotojob(${i.id});">
                            <i class="fas fa-check-circle"></i>
                            <span>${lang2(i)}</span>
                            <input type="radio" class="hide" name="section_id" value="${i.id}">
                        </label>`);
        }

        var c = 0;
        function gotojob(job){
            $(".add_job2").html('').hide(0);
            if(c == 0){
                $.get('/get_jobs_from_section_id',{job},function(e){
                    e.forEach(add_job);
                    $(".add_job2").fadeIn();
                });
                c = 1;
            }
            setTimeout(() => {
                c = 0;
            }, 100);
        }

        function add_job(i){
            $(".add_job2").append(`<label class="choosse">
                            <i class="fas fa-check-circle"></i>
                            <span>${lang2(i)}</span>
                            <input type="radio" class="hide" name="job_id" value="${i.id}">
                        </label>`);
        }

        function lang2(model){
            if(lang == "ar"){
                return model.name_ar;
            }
            return model.name_en;
        }
    </script>
@endsection