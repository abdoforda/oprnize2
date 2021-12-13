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
                            <h4>{{ __('nationalities') }}</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a>{{ auth()->user()->company->name }}</a></li>
                                <li class="breadcrumb-item active">{{ __('nationalities') }}</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-end d-none d-sm-block">
                            <a data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-lg" class="btn btn-success">{{__('Add a new nationality')}}</a>
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

                                <h4 class="header-title">{{ __('nationalities') }}</h4>
                                <p class="card-title-desc">
                                    {{__('You can add and edit nationalities from this page')}}
                                </p>

                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>{{__('Name (AR)')}}</th>
                                            <th>{{__('Name (EN)')}}</th>
                                            <th>{{__('Options')}}</th>
                                        </tr>
                                    </thead>


                                    <tbody class="append2">
                                        @foreach ($nationalities as $index => $nationality)
                                        <tr id="updater{{$index}}">
                                            <td class="ed_ar">{{ $nationality->name_ar }}</td>
                                            <td class="ed_en">{{ $nationality->name_en }}</td>
                                            <td>
                                                <a onclick="update_nationality(this,'updater{{$index}}')" data-id="{{ $nationality->id }}"><button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg2" class="btn btn-info btn-sm waves-effect waves-light"><i class="fas fa-user-edit"></i> {{__('Edit')}}</button></a>
                                                <button onclick="delete_tr(this,'nationalities','updater{{$index}}',)" data-id="{{ $nationality->id }}" type="button" class="btn btn-danger btn-sm waves-effect waves-light"><i class="fas fa-trash"></i> {{__('Delete')}}</button>
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

<script>
var idd = "";
function update_nationality(thiss,id){

    var thiss = $(thiss);
    idd = id;
    var show_name_ar = thiss.closest('tr').find('.ed_ar').text();
    var show_name_en = thiss.closest('tr').find('.ed_en').text();
    $("#edit_name_ar").val(show_name_ar);
    $("#edit_name_en").val(show_name_en);
    $(".ajax_nationality2").attr('action','/nationality/'+thiss.data('id'));

}
   $(document).ready(function(e) {
   var domain = "{{ request()->getHost() }}";
   $(".ajax_nationality").ajaxForm({
                complete: function(data){
                    var mess = '';
                    if(data.status == 422){
                        for(let x in data.responseJSON.errors){
                            mess += "<p>"+data.responseJSON.errors[x][0]+"</p>";
                        }
                        $(".message").hide(0).html(mess).fadeIn();
                    }else if(data.status == 201){
                        
                        $(".append2").prepend(`<tr id="asdww${data.responseJSON.id}">
                                            <td  class="ed_ar">${data.responseJSON.name_ar}</td>
                                            <td  class="ed_en">${data.responseJSON.name_en}</td>
                                            <td>
                                                <a onclick="update_nationality(this,'asdww${data.responseJSON.id}')" data-id="${data.responseJSON.id}"><button type="button" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg2" class="btn btn-info btn-sm waves-effect waves-light"><i class="fas fa-user-edit"></i> {{__('Edit')}}</button></a>
                                                <button onclick="delete_tr(this,'nationalities','asdww${data.responseJSON.id}',)" data-id="${data.responseJSON.id}" type="button" class="btn btn-danger btn-sm waves-effect waves-light"><i class="fas fa-trash"></i> {{__('Delete')}}</button>
                                            </td>
                                        </tr>`);
                                        $("#datatable").DataTable();
                        $(".clcl").trigger('click');
                    }
                    
                }
            });

            $(".ajax_nationality2").ajaxForm({
                complete: function(data){
                    var mess = '';
                    if(data.status == 422){
                        for(let x in data.responseJSON.errors){
                            mess += "<p>"+data.responseJSON.errors[x][0]+"</p>";
                        }
                        $(".message2").hide(0).html(mess).fadeIn();
                    }else if(data.status == 200){

                        $("#"+idd).find(".ed_ar").text(data.responseJSON.name_ar);
                        $("#"+idd).find(".ed_en").text(data.responseJSON.name_en);
                        $("#datatable").DataTable();
                        $(".clcl2").trigger('click');
                    }
                    
                }
            });

        });
</script>

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


@section('models')
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0" id="myLargeModalLabel">{{__('Add a new nationality')}}</h5>
            <button type="button" class="btn-close clcl" data-bs-dismiss="modal" aria-label="Close">

            </button>
        </div>
        <div class="modal-body">

            <form action="/nationality" class="ajax_nationality" method="post">
                @csrf
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">{{__('Nationality Name (AR)')}}</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name_ar" id="example-text-input">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">{{__('Nationality Name (EN)')}}</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name_en" id="example-text-input">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit"
                            class="btn btn-success waves-effect waves-light">{{__('Save')}}</button>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10 text-center message">

                    </div>
                </div>

            </form>

        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0" id="myLargeModalLabel">{{__('Nationality modification')}}</h5>
            <button type="button" class="btn-close clcl2" data-bs-dismiss="modal" aria-label="Close">

            </button>
        </div>
        <div class="modal-body">

            <form action="" class="ajax_nationality2" method="post">
                @method('PUT')
                @csrf
                <div class="row mb-3">
                    <label for="edit_name_ar" class="col-sm-2 col-form-label">{{__('Nationality Name (AR)')}}</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name_ar" id="edit_name_ar">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="edit_name_en" class="col-sm-2 col-form-label">{{__('Nationality Name (EN)')}}</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name_en" id="edit_name_en">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit"
                            class="btn btn-success waves-effect waves-light">{{__('Save')}}</button>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10 text-center message2">

                    </div>
                </div>

            </form>

        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection