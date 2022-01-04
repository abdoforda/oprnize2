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
                            <h4>{{ __('Permission') }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a>{{ auth()->user()->company->name }}</a></li>
                                <li class="breadcrumb-item">{{ __('Permission') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="container-fluid">

            <div class="page-content-wrapper">
                <form action="/update_permasstion" class="ajax_em_store" method="post">

                    @csrf
                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                    <div class="row">
                        <div class="col-12">
                            <!-- Left sidebar -->
                            <div class="email-leftbar card">
    
                                <h6 class="mt-4">{{ __('Permission') }}</h6>
                                <div class="mail-list mt-1">
                                        <a class="click_show" data-show="hide01"><i class="mdi mdi-star-outline  float-end"></i> {{__('Employees')}} </a>
                                        <a class="click_show" data-show="hide02"><i class="mdi mdi-star-outline  float-end"></i> {{__('Leave Types')}} </a>
                                        <a class="click_show" data-show="hide03"><i class="mdi mdi-star-outline  float-end"></i> {{__('discount')}} </a>
                                        <a class="click_show" data-show="hide04"><i class="mdi mdi-star-outline  float-end"></i> {{__('overtime')}} </a>
                                        <a class="click_show" data-show="hide05"><i class="mdi mdi-star-outline  float-end"></i> {{__('payrolls')}} </a>
                                        <a class="click_show" data-show="hide06"><i class="mdi mdi-star-outline  float-end"></i> {{__('Settings')}} </a>
                                        <button class="btn btn-primary" type="submit" style="width: 100%;">{{ __('Save') }}</button>
                                    </div>
                            </div>
                            <!-- End Left sidebar -->
    
                            <!-- Right Sidebar -->
                            <div class="email-rightbar mb-3">
    
    
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="header-title">{{__('Permission')}}</h4>
                                                
                                                
                                                <div class="hide hide01" style="display: block;">
    
                                                    <div class="row checkbox2" data-select='{{ $employee->user->getAllPermissions() }}'>
                                                        
                                                        <label for="cl0" class="choosse checkbox2_item">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>{{ __('add employee') }}</span>
                                                        </label>
                                                        <input id="cl0" type="checkbox" class="hide" name="permissions[]" value="1">
    
                                                        <label for="cl1" class="choosse checkbox2_item">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>{{ __('edit employee') }}</span>
                                                        </label>
                                                        <input id="cl1" type="checkbox" class="hide" name="permissions[]" value="2">
    
    
                                                        <label for="cl2" class="choosse checkbox2_item">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>{{ __('delete employee') }}</span>
                                                        </label>
                                                        <input id="cl2" type="checkbox" class="hide" name="permissions[]" value="3">
    
                                                    </div>
    
                                                </div>
    
                                                <div class="hide hide02">
    
                                                    <div class="row checkbox2" data-select='{{ $employee->user->getAllPermissions() }}'>
                                                        
                                                        @php $index = "asd4"; @endphp
                                                        <label for="{{ $index }}" class="choosse checkbox2_item">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>{{ __('add vacation') }}</span>
                                                        </label>
                                                        <input id="{{ $index }}" type="checkbox" class="hide" name="permissions[]" value="4">
    
                                                        @php $index = "asd5"; @endphp
                                                        <label for="{{ $index }}" class="choosse checkbox2_item">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>{{ __('edit vacation') }}</span>
                                                        </label>
                                                        <input id="{{ $index }}" type="checkbox" class="hide" name="permissions[]" value="5">
    
                                                        @php $index = "asd6"; @endphp
                                                        <label for="{{ $index }}" class="choosse checkbox2_item">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>{{ __('delete vacation') }}</span>
                                                        </label>
                                                        <input id="{{ $index }}" type="checkbox" class="hide" name="permissions[]" value="6">
    
                                                    </div>
    
                                                </div>
    
                                                <div class="hide hide03">
    
                                                    <div class="row checkbox2" data-select='{{ $employee->user->getAllPermissions() }}'>
                                                        
                                                        @php $index = "asd7"; @endphp
                                                        <label for="{{ $index }}" class="choosse checkbox2_item">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>{{ __('add discount') }}</span>
                                                        </label>
                                                        <input id="{{ $index }}" type="checkbox" class="hide" name="permissions[]" value="7">
    
                                                        @php $index = "asd8"; @endphp
                                                        <label for="{{ $index }}" class="choosse checkbox2_item">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>{{ __('delete discount') }}</span>
                                                        </label>
                                                        <input id="{{ $index }}" type="checkbox" class="hide" name="permissions[]" value="8">
    
                                                    </div>
    
                                                </div>
    
                                                <div class="hide hide04">
    
                                                    <div class="row checkbox2" data-select='{{ $employee->user->getAllPermissions() }}'>
                                                        
                                                        @php $index = "asd9"; @endphp
                                                        <label for="{{ $index }}" class="choosse checkbox2_item">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>{{ __('add overtime') }}</span>
                                                        </label>
                                                        <input id="{{ $index }}" type="checkbox" class="hide" name="permissions[]" value="9">
    
                                                        @php $index = "asd10"; @endphp
                                                        <label for="{{ $index }}" class="choosse checkbox2_item">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>{{ __('delete overtime') }}</span>
                                                        </label>
                                                        <input id="{{ $index }}" type="checkbox" class="hide" name="permissions[]" value="10">
    
                                                    </div>
    
                                                </div>
    
                                                <div class="hide hide05">
    
                                                    <div class="row checkbox2" data-select='{{ $employee->user->getAllPermissions() }}'>
                                                        
                                                        @php $index = "asd11"; @endphp
                                                        <label for="{{ $index }}" class="choosse checkbox2_item">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>{{ __('add payroll') }}</span>
                                                        </label>
                                                        <input id="{{ $index }}" type="checkbox" class="hide" name="permissions[]" value="11">
    
                                                        @php $index = "asd12"; @endphp
                                                        <label for="{{ $index }}" class="choosse checkbox2_item">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>{{ __('delete payroll') }}</span>
                                                        </label>
                                                        <input id="{{ $index }}" type="checkbox" class="hide" name="permissions[]" value="12">
    
                                                    </div>
    
                                                </div>
    
                                                <div class="hide hide06">
    
                                                    <div class="row checkbox2" data-select='{{ $employee->user->getAllPermissions() }}'>
                                                        
                                                        @php $index = "asd13"; @endphp
                                                        <label for="{{ $index }}" class="choosse checkbox2_item">
                                                            <i class="fas fa-check-circle"></i>
                                                            <span>{{ __('settings') }}</span>
                                                        </label>
                                                        <input id="{{ $index }}" type="checkbox" class="hide" name="permissions[]" value="13">
    
                                                    </div>
    
                                                </div>
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                
    
                            </div>
                            <!-- card -->
    
                        </div>
                        <!-- end Col-9 -->
    
                    </div>

                </form>
            </div>


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('layouts.footer')
    <style>
        .hide{
            display: none;
        }
    </style>
</div>
<!-- end main content-->

@endsection

@section('script')
    <script>
        $(document).ready(function(e) {
            $(".ajax_em_store").ajaxForm({
                beforeSend : function(){
                    $(".invalid-feedback").remove();
                    $(".is-invalid").removeClass("is-invalid");
                },
                complete: function(data){
                    var mess = '';
                    if(data.status == 422){

                        error_message(data.responseJSON.message);
                        errors(data.responseJSON.errors);

                    }else if(data.status == 200){
                        Success("{{__('Saved Ok')}}");
                    }
                    
                }
            });
        });

        $("body").on('click','.checkbox2_item',function(){
            console.log('asdasds');
            if ($(this).hasClass("clickable")) {
                $(this).removeClass("clickable");
                $(this).find("i").hide(0);
            }else{
                $(this).addClass("clickable");
                $(this).find("i").fadeIn();
            }
        });

        $(".click_show").click(function(e) {
            var showw = $(this).data("show");
            $(".hide").fadeOut(300);
            $("."+showw).delay(300).fadeIn(300);
        });
        
    </script>
@endsection