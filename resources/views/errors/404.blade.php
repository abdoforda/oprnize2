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

                                </div>

                                <div class="text-center p-3">

                                    <h1 class="error-page mt-5"><span>404</span></h1>
                                    <h4 class="mb-4 mt-5">Sorry, page not found</h4>
                                    <p class="mb-4 mx-auto">It will be as simple as Occidental in fact, it will Occidental to an English person</p>
                                    <a class="btn btn-primary waves-effect waves-light" href="{{ env('APP_URL') }}"><i class="mdi mdi-home"></i>الرجوع للصفحة الرئيسية</a>
                                </div>

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
    </script>
@endsection