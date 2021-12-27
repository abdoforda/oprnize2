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
                            <h4>{{ __('payrolls') }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a>{{ auth()->user()->company->name }}</a></li>
                                <li class="breadcrumb-item active">{{ __('payrolls') }}</li>
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

                                <h4 class="header-title">{{ __('payrolls') }}</h4>
                                <p class="card-title-desc">
                                    {{__('You can add and edit through this page')}}
                                </p>

                                <div class="container" style="margin-bottom: 24px;">
                                    <div class="row bt_num2">
                                        <div class="col-sm">
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light">
                                                Mounth<br />
                                                {{ $payroll->date }}
                                            </button>
                                          </div>

                                          <div class="col-sm">
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light">
                                                Total<br />
                                                -----
                                            </button>
                                          </div>

                                          <div class="col-sm">
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light">
                                                Employees<br />
                                                {{ count($payroll->ems()) }}
                                            </button>
                                          </div>

                                          <div class="col-sm">
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light">
                                                Got Advanced<br />
                                                -----
                                            </button>
                                          </div>

                                          <div class="col-sm">
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light">
                                                Suspended<br />
                                                -----
                                            </button>
                                          </div>

                                          <div class="col-sm">
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light">
                                                Paused<br />
                                                -----
                                            </button>
                                          </div>
                                    </div>
                                  </div>

                                  <div class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap table-responsive"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>{{__('Job_Number')}}</th>
                                            <th>{{__('Name')}}</th>
                                            <th>{{__('Contract Start Date')}}</th>
                                            <th>{{__('Basic')}}</th>
                                            <th>{{__('Housing')}}</th>
                                            <th>{{__('Trans')}}</th>

                                            <th>{{__('Allowances')}}</th>
                                            <th>{{__('Overtime')}}</th>
                                            <th>{{__('Gosi')}}</th>
                                            <th>{{__('Absence')}}</th>
                                            <th>{{__('Violation')}}</th>
                                            <th>{{__('Advanced')}}</th>
                                            <th>{{__('total deductions')}}</th>
                                            <th>{{__('Net Salary')}}</th>
                                        </tr>
                                    </thead>


                                    <tbody class="append2">
                                        @foreach ($payroll->ems() as $em)
                                            <tr>
                                                <td>{{$em->job_number}}</td>
                                                <td>{{$em->name}}</td>
                                                <td>{{$em->contract_start_date}}</td>
                                                <td style="background: #f7f7f7;">{{$em->salary}}</td>
                                                <td style="background: #f7f7f7;">{{ number_format($em->payroll_hra(),2) }}</td>
                                                <td style="background: #f7f7f7;">{{ number_format($em->payroll_trans(),2) }}</td>
                                                <td style="background: #bbffc3;">{{ number_format($em->payroll_allowances(), 2) }}</td>
                                                
                                                <td style="background: #bbffc3;">{{ number_format($em->payroll_overtime, 2) }}</td>
                                                <td style="background: #ffd3d3;">{{ number_format($em->payroll_gosi() *-1, 2) }}</td>
                                                <td style="background: #ffd3d3;">{{ number_format($em->payroll_absence() * -1,2) }}</td>
                                                <td> ------ </td>
                                                <td> ------ </td>
                                                <td style="background: #ffd3d3;"> {{ number_format(($em->payroll_gosi()+$em->payroll_absence())*-1,2) }} </td>
                                                <td>{{ number_format($em->payroll_net_salary()+$em->payroll_overtime, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
<!-- DataTables -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
    <link href="{{ asset('assets/libs/bootstrap-editable/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
<!-- Responsive examples -->
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Plugins js -->

<script src="{{ asset('assets/libs/bootstrap-editable/js/index.js') }}"></script>
<script>
$(document).ready(function(e) {

});

</script>

@if (app()->getLocale() == "ar")
<script>
    $("#datatable").DataTable({
            "responsive": true,
            "oLanguage": { "sUrl": "{{ asset('assets/libs/datatables.net/js/ar.json') }}" }
        });
</script>
@else
<script>
    $("#datatable").DataTable({
        "responsive": true,
    });
</script>
@endif


@endsection
