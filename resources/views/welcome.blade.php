@extends('layouts.app')

<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-5">
                    <a href="index.html" class="logo"><img src="assets/images/logo-dark.png" height="24"
                            alt="logo"></a>
                            <br /><br />
                    <h5 class="font-size-16 mb-4">{{__('Oprnize Technical Services Company')}}</h5>

                    <h4 class="mt-5">{{__('You can start now')}}</h4>

                    <a href="/workspace"><button type="button" class="btn btn-outline-info waves-effect waves-light">{{__('Log in here')}}</button></a>
                    <a href="/register"><button type="button" class="btn btn-outline-info waves-effect waves-light">{{__('Free 30 day trial')}}</button></a>

                    <div class="mt-4">
                        <img src="assets/images/coming-soon.png" class="img-fluid" alt="">
                    </div>

                    <div class="row justify-content-center mt-5 pt-3">
                        <div class="col-md-8">
                            <div data-countdown="2021/12/31" class="counter-number"></div>
                        </div> <!-- end col-->
                    </div> <!-- end row-->
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>
