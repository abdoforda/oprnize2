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
                            <h4>{{ __('Approvalstaff') }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a>{{ auth()->user()->company->name }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Approvalstaff') }}</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-end d-none d-sm-block">
                            <a data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-lg" class="btn btn-success">{{__('Add a new')}} {{__('Approvalstaff')}}</a>
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

                                <h4 class="header-title">{{ __('Approvalstaff') }}</h4>
                                <p class="card-title-desc">
                                    {{__('You can add and edit through this page')}}
                                </p>

                                <center>
                                    <select onchange="update_employee(this)" name="employees" id='pre-selected-options' multiple='multiple'>
                                        @foreach ($employees as $employee)
                                            <option @if ($employee->approvalstaff)
                                                selected
                                            @endif value='{{ $employee->id }}'>{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </center>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



    @include('layouts.footer')
</div>
@endsection

@section('style')

<style>
    .ms-container{
  background: transparent url("{{ asset('assets/image/switch.png') }}") no-repeat 50% 50%;
  width: 370px;
}

.ms-container:after{
  content: ".";
  display: block;
  height: 0;
  line-height: 0;
  font-size: 0;
  clear: both;
  min-height: 0;
  visibility: hidden;
}

.ms-container .ms-selectable, .ms-container .ms-selection{
  background: #fff;
  color: #555555;
  float: left;
  width: 45%;
}
.ms-container .ms-selection{
  float: right;
}

.ms-container .ms-list{
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border linear 0.2s, box-shadow linear 0.2s;
  -moz-transition: border linear 0.2s, box-shadow linear 0.2s;
  -ms-transition: border linear 0.2s, box-shadow linear 0.2s;
  -o-transition: border linear 0.2s, box-shadow linear 0.2s;
  transition: border linear 0.2s, box-shadow linear 0.2s;
  border: 1px solid #ccc;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  position: relative;
  height: 200px;
  padding: 0;
  overflow-y: auto;
}

.ms-container .ms-list.ms-focus{
  border-color: rgba(82, 168, 236, 0.8);
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
  outline: 0;
  outline: thin dotted \9;
}

.ms-container ul{
  margin: 0;
  list-style-type: none;
  padding: 0;
}

.ms-container .ms-optgroup-container{
  width: 100%;
}

.ms-container .ms-optgroup-label{
  margin: 0;
  padding: 5px 0px 0px 5px;
  cursor: pointer;
  color: #999;
}

.ms-container .ms-selectable li.ms-elem-selectable,
.ms-container .ms-selection li.ms-elem-selection{
  border-bottom: 1px #eee solid;
  padding: 2px 10px;
  color: #555;
  font-size: 14px;
}

.ms-container .ms-selectable li.ms-hover,
.ms-container .ms-selection li.ms-hover{
  cursor: pointer;
  color: #fff;
  text-decoration: none;
  background-color: #08c;
}

.ms-container .ms-selectable li.disabled,
.ms-container .ms-selection li.disabled{
  background-color: #eee;
  color: #aaa;
  cursor: text;
}
</style>

@endsection

@section('script')
<script src="{{ asset('assets/js/jquery.multi-select.js') }}"></script>
<script type="text/javascript">
    // run pre selected options
    $('#pre-selected-options').multiSelect({
      keepOrder: true,
      afterSelect: function(value){
        var type = "insert";
        $.get("/approval_staff_update", {type,value},function(e){

        });
      },
      afterDeselect: function(value){
        var type = "delete";
        $.get("/approval_staff_update", {type,value},function(e){

        });
      }
    });

    function update_employee(ee){
        console.log($(ee).val());
    }
    </script>
@endsection

