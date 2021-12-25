@extends('layouts.app')

@section('content')

<div class="home-center">
    <div class="home-desc-center">

        <div class="container">

            <div class="home-btn"><a href="/" class="text-white router-link-active"><i class="fas fa-home h2"></i></a>
            </div>


            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="px-2 py-3">


                                <div class="text-center">
                                    <a href="index.html">
                                        <img src="assets/images/logo-dark.png" height="22" alt="logo">
                                    </a>

                                    <h5 class="text-primary mb-2 mt-4">{{__('Register as a company')}}</h5>
                                    <p class="text-muted">{{__('الخطوات سهله وبسيطة')}}</p>

                                </div>

                                <form method="POST" action="/register" class="form-horizontal ajax">
                                    @csrf

                                    <div class="mb-3 o-email">
                                        <label for="useremail">{{__('Email')}}</label>
                                        <input name="email" type="email" class="form-control" id="useremail"
                                            placeholder="{{__('Write')}} {{__('Email')}}">
                                    </div>


                                    <div class="mb-3 o-subdomain" style="display: none;">
                                        <label for="useremail">{{__('Company subdomain')}}</label>
                                        <div class="input-group" style="direction: ltr;">
                                            <input name="domain" style="border-radius: 6px 0px 0px 6px;" type="text"
                                                class="form-control" placeholder="{{__('Company subdomain')}}">
                                            <span style="border-radius: 0px 6px 6px 0px;"
                                                class="input-group-text">.oprnize.com</span>
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-12 text-end"
                                        >

                                            <button @if (app()->getLocale() == "en") style="float: right;" @endif onclick="next();"
                                                class="btsub btn btn-primary w-md waves-effect waves-light"
                                                type="button">{{__('Next')}}</button>

                                            <button @if (app()->getLocale() == "ar") style="float: right;" @endif onclick="back();"
                                                class="btn btn-primary w-md waves-effect waves-light bt-back"
                                                type="button">{{__('Previous')}}</button>
                                        </div>
                                    </div>


                                    <div class="row mb-0">
                                        <div class="col-12 text-center message">

                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-center text-white">
                        <p>{{__('If you are our client ?')}} <a href="/workspace" class="fw-bold text-white">{{__('Log in here')}}</a> </p>

                    </div>
                </div>
            </div>

        </div>


    </div>
    <!-- End Log In page -->
</div>
@endsection

@section('script')
<script>
    $("body").attr("class", "authentication-bg bg-primary");
        function next(){
            $(".message").hide(0);
            var email = $("#useremail").val();
            
            if(email == ''){
                $(".message").hide(0).html("{{__('You must enter the email')}}").fadeIn();
                return;
            }

            var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
            if(!pattern.test(email))
            {
                $(".message").hide(0).html("{{__('Enter your email correctly')}}").fadeIn();
                return;
            }

            $.get('check_email',{email},function(ee){

                if(ee == "asd"){
                    $(".bt-back").slideDown();
                $(".o-email").slideUp();
                $(".o-subdomain").slideDown();
                setTimeout(() => {
                    $(".btsub").text("{{__('Register now')}}").attr('type','submit');
                }, 100);
                $("#useremail").removeClass("is-invalid");
                $(".message").hide(0).html("").fadeIn().css({"color":"red"});
                }else{
                    $(".message").hide(0).html("{{__('This mail is already registered with us')}}").fadeIn().css({"color":"red"});
            $("#useremail").addClass("is-invalid");
                }

                
                
            });

            
           

        }

        function back(){

            $(".bt-back").fadeOut();
            $(".o-subdomain").slideUp();
            $(".o-email").slideDown();
            $(".btsub").text("{{__('Next')}}").attr('type','button');

        }

        $(document).ready(function(e) {
            var domain = "{{ request()->getHost() }}";
            $(".ajax").ajaxForm({
                complete: function(data){
                    var mess = '';
                    if(data.status == 422){
                        for(let x in data.responseJSON.errors){
                            mess += "<p>"+data.responseJSON.errors[x][0]+"</p>";
                        }
                        $(".message").hide(0).html(mess).fadeIn();
                        console.log(data.responseJSON.errors);
                    }else if(data.status == 201){
                        $(".message").hide(0).html("{{__('Your company has been successfully registered, and the password has been sent to your email with login details')}}").fadeIn();
                        setTimeout(() => {
                            window.location.href = "http://"+data.responseJSON.domain+"."+domain;
                        }, 15000);
                        
                    }
                    
                }
            });
        });

</script>
@endsection

@section('style')
<style>
    .message {
        text-align: center;
        margin-top: 30px;
    }

    .bt-back {
        display: none;
    }
</style>
@endsection