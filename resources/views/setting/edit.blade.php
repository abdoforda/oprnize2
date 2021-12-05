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
                         <h4>{{ __('Settings') }}</h4>
                             <ol class="breadcrumb m-0">
                                 <li class="breadcrumb-item"><a>{{ auth()->user()->company->name_en }}</a></li>
                                 <li class="breadcrumb-item"><a>{{__('Company')}}</a></li>
                                 <li class="breadcrumb-item active">{{ __('Settings') }}</li>
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
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">{{ __('Company settings and features') }}</h4>
                                <p class="card-title-desc">{{ __('The fildes in color') }} <code class="highlighter-rouge dir01">{{ __('red') }}</code> {{ __('are mandatory') }}</p>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label red">{{ __('name company (EN)') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name_en" type="text" placeholder="{{ __('name company (EN)') }}" id="example-text-input">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input2" class="col-sm-2 col-form-label red">{{ __('name company (AR)') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name_ar" type="text" placeholder="{{ __('name company (AR)') }}" id="example-text-input2">
                                    </div>
                                </div>

                                
                                <div class="row mb-3">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" type="email" placeholder="{{ __('Email') }}" id="example-email-input">
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label for="example-tel-input" class="col-sm-2 col-form-label">{{ __('Telephone') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="phone" type="tel" placeholder="{{ __('Telephone') }}" id="example-tel-input">
                                    </div>
                                </div>
                                

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">{{ __('Overtime Settings') }}</h4>
                                <p class="card-title-desc red">{{ __('Choose a method for calculating overtime') }}</p>
                                <div class="row choosse-input">
                                    
                                    <label class="choosse">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ __('According to the Saudi system') }}</span>
                                        <input type="radio" class="hide" name="extra_work" value="saudi">
                                    </label>

                                    <label class="choosse">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ __('only basic') }}</span>
                                        <input type="radio" class="hide" name="extra_work" value="basic">
                                    </label>

                                    <label class="choosse">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ __('Total') }}</span>
                                        <input type="radio" class="hide" name="extra_work" value="total">
                                    </label>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">{{ __('Payroll settings') }}</h4>
                                <p class="card-title-desc red">{{ __('How to calculate daily salary') }}</p>

                                <div class="row choosse-input">
                                    
                                    <label class="choosse">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ __('Calculate all months as 30 days') }}</span>
                                        <input type="radio" class="hide" name="month_calculator" value="30days">
                                    </label>

                                    <label class="choosse">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ __('Calculating the month with its actual days') }}</span>
                                        <input type="radio" class="hide" name="month_calculator" value="different_days">
                                    </label>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="header-title">{{ __('nationalities') }}</h4>
                                <p class="card-title-desc">{{ __('Choose the nationalities you want to activate in the system') }}</p>
                                
                                <div class="row checkbox2">
                                    
                                    @php
                                        $arra = [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
                                    @endphp
                                    @foreach ($arra as $item)
                                    <label class="choosse checkbox2_item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ __('Egypt') }}</span>
                                        <input type="checkbox" class="hide" name="extra_work" value="Egypt">
                                    </label>
                                    @endforeach

                                    
                                </div>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>


            </div>

            
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

  
    
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Oprnize.
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection

@section('script')
    <script>
        $(".choosse-input").on('click','.choosse',function(){
            $(this).closest(".choosse-input").find(".choosse").removeClass("clickable");
            $(this).closest(".choosse-input").find(".choosse").find("i").hide(0);

            $(this).find("i").fadeIn();
            $(this).addClass("clickable");
        });

        $("body").on('click','.checkbox2_item',function(){
            console.log('asdasds');
            if ($(this).hasClass("clickable")) {
                $(this).removeClass("clickable");
            }else{
                $(this).addClass("clickable");
            }
            
        });

    </script>
@endsection