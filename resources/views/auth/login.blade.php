@extends('layouts.app')

@section('content')
<div class="home-center">
    <div class="home-desc-center">

        <div class="container">

            <div class="home-btn"><a href="/" class="text-white router-link-active"><i
                        class="fas fa-home h2"></i></a></div>


            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="px-2 py-3">


                                <div class="text-center">
                                    <a href="index.html">
                                        <img src="assets/images/logo-dark.png" height="22" alt="logo">
                                    </a>

                                    <h5 class="text-primary mb-2 mt-4">{{__('You welcome in')}} {{ $ex[0] }}</h5>
                                    
                                </div>


                                <form method="POST" action="/login" class="form-horizontal mt-4 pt-2 ajax">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username">{{__('Email')}}</label>
                                        <input type="email" name="email" class="form-control" id="username"
                                            placeholder="{{__('Write')}} {{__('Email')}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="userpassword">{{__('Password')}}</label>
                                        <input type="password" name="password" class="form-control" id="userpassword"
                                            placeholder="{{__('Write')}} {{__('Password')}}">
                                    </div>

                                    <div class="mb-3">
                                            <div class="form-check">
                                                <input name="remember" type="checkbox" class="form-check-input"
                                                    id="customControlInline">
                                                <label class="form-label"
                                                    for="customControlInline">{{__('Remember')}}</label>
                                            </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-primary w-100 waves-effect waves-light"
                                            type="submit">{{__('Login in')}}</button>
                                    </div>
                                    

                                    <br />
                                    <div class="row mb-0">
                                        <div class="col-12 text-center message">

                                        </div>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> {{__('forget your password')}}</a>
                                    </div>
                                    


                                </form>

                              
                            </div>
                        </div>
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
                    }else if(data.status == 200){

                        if(data.responseText == "success"){
                            $(".message").hide(0).html("{{__('You are logged in, you are being transferred now')}}").fadeIn();
                            setTimeout(() => {
                            window.location.href = window.location.href;
                        }, 3000);
                        }else{
                            $(".message").hide(0).html(data.responseText).fadeIn();
                        }
                    }
                    
                }
            });
        });


</script>
@endsection

