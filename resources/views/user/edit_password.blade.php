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
                             </ol>
                     </div>
                 </div>
             </div>
            </div>
            @if($errors->any())
                                    <h4>{{$errors->first()}}</h4>
                                @endif
         </div>
         <!-- end page title -->    


        <div class="container-fluid">

            <form action="/edit_password" class="ajax_setting" method="post">
                @csrf
            <div class="page-content-wrapper">

                <div class="row" >
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                             
                                <h4 class="header-title">{{ __('Edit password') }}</h4>
                                <p class="card-title-desc">
                                    {{ __('Continue to use You must change your password Your own password') }}
                                </p>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label red">{{ __('password') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="password"  type="password" placeholder="{{ __('password') }}" id="example-text-input">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input2" class="col-sm-2 col-form-label red">{{ __('password_confirmation') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="password_confirmation" type="password" placeholder="{{ __('password_confirmation') }}" id="example-text-input2">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <button type="submit" class="btn btn-success waves-effect waves-light">{{ __('Save') }}</button>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div>

            
        </form>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    
    
    @include('layouts.footer')
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(e) {
            $(".ajax_setting").ajaxForm({
                beforeSend : function(){
                    $(".invalid-feedback").remove();
                    $(".is-invalid").removeClass("is-invalid");
                },
                complete: function(data){
                    var mess = '';
                    if(data.status == 422){
                        errors(data.responseJSON.errors);
                        for(let x in data.responseJSON.errors){
                            mess += "<p>"+data.responseJSON.errors[x][0]+"</p>";
                        }
                        $(".massage_errors").hide(0).html(mess).fadeIn();
                        $(".show_errors").trigger('click');
                    }else if(data.status == 200){
                        Success("{{__('password_confirmation_ok')}}");
                        window.location.href = '/';
                    }
                }
            });
        });
    </script>

@endsection