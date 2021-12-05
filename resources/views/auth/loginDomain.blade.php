@extends('layouts.app')

@section('content')
<br />
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

                                    <h5 class="text-primary mb-2 mt-4">{{__('Write')}} {{__('Domain')}}</h5>
                                    
                                </div>


                                <form method="POST" action="/checkdomain" class="form-horizontal mt-4 pt-2 ajax">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username">{{__('Domain')}}</label>
                                        <input style="direction: ltr;" type="text" name="domain" class="form-control" id="username"
                                            placeholder="{{__('Domain')}} {{__('Company')}}">
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
                    if(data.status == 200){

                        if(data.responseText == "error"){
                            $(".message").hide(0).html("{{__('This domain does not exist')}}").fadeIn();
                        }else{
                            console.log(data);
                            $(".message").hide(0).html("{{__('You are logged in, you are being transferred now')}}").fadeIn();
                            setTimeout(() => {
                            window.location.href = "http://"+data.responseJSON.domain+"."+domain+"/login";
                        }, 1000);
                        }
                    }
                    
                }
            });
        });


</script>
@endsection

