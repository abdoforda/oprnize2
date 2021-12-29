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
                            <h4>{{ __('Requests') }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a>{{ auth()->user()->company->name }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Requests') }}</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-end d-none d-sm-block">
                            <a href="/request/create" class="btn btn-success">{{__('New Request')}}</a>
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

                                <h4 class="header-title">{{ __('Requests') }}</h4>
                                <p class="card-title-desc">
                                    {{__('You can add and edit Requests from this page')}}
                                </p>

                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>{{__('the kind of holiday')}}</th>
                                            <th>{{__('The number of days')}}</th>
                                            <th>{{__('Date')}}</th>
                                            <th>{{__('Info')}}</th>
                                            <th>{{__('Options')}}</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($nationalities as $index => $item)
                                        <tr id="updater{{$index}}">
                                            <td><a href="/request/{{ $item->id }}">{{ $item->myvacation->vacation->name }}</a></td>
                                            <td>{{ $item->myvacation->the_number_of_days() }}</td>
                                            <td style="text-align: center;">{{ $item->myvacation->start }} <br /> {{ __('To') }} <br /> {{ $item->myvacation->end }}</td>
                                            <td>{{ $item->myvacation->visa }} <br/> {{ $item->myvacation->ticket }} <br/> {{ $item->myvacation->pay_in_advance }}</td>
                                            <td>
                                                <a href="/request/{{ $item->id }}/edit"><button type="button" class="btn btn-info btn-sm waves-effect waves-light"><i class="fas fa-user-edit"></i> {{__('Edit')}}</button></a>
                                                <button onclick="delete_tr(this,'requests','updater{{$index}}',)" data-id="{{ $item->id }}" type="button" class="btn btn-danger btn-sm waves-effect waves-light"><i class="fas fa-trash"></i> {{__('Delete')}}</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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
@endsection

@section('script')
<!-- Responsive examples -->
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

@if (app()->getLocale() == "ar")
<script>
    $("#datatable").DataTable({
            "oLanguage": { "sUrl": "{{ asset('assets/libs/datatables.net/js/ar.json') }}" }
        });
</script>
@else
<script>
    $("#datatable").DataTable();
</script>
@endif


@endsection