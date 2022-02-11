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


                                <table>
                                    <tbody>
                                        <td>Leave</td>
                                        <td></td>
                                    </tbody>
                                </table>

                                <div class="table-responsive">
                                    <table class="table table-bordered border-primary mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Leave</th>
                                                @foreach ($approvalstaffs as $item)
                                                    <td class="relitve">
                                                        <label>
                                                            <input @if ($item->manager == "true")
                                                                checked
                                                            @endif type="checkbox" onChange="update_manger(this);" data-id='{{ $item->id }}' >
                                                            Direct manager
                                                        </label>
                                                            <div>
                                                                <a class="inline-department" href="#" data-type="select" data-pk="{{ $item->id }}" @if ($item->type == 'employee' && $item->manager != "true") data-value="{{ $item->employee_id }}" @endif  data-url="/update_approvalstaffs_employee" > @if ($item->type == 'employee' && $item->manager != "true") {{ $item->employee->name }} @else Employee @endif </a>
                                                            </div>
                                                            <div style="background: #ddd; padding: 5px; border-radius: 50px; margin: 6px 0px;">
                                                                
                                                                @if ($item->manager != "true")
                                                                {{ $item->employee->name }} 
                                                                @else
                                                                manager
                                                                @endif
                                                                
                                                            </div>
                                                            <div>
                                                                <a class="inline-department2" href="#" data-type="select" data-pk="{{ $item->id }}" @if ($item->type == 'section' && $item->manager != "true") data-value="{{ $item->employee_id }}" @endif data-url="/update_approvalstaffs_section" >@if ($item->type == 'section' && $item->manager != "true") {{ $item->employee->name }} @else Position @endif</a>
                                                            </div>

                                                            <i onclick="delete_approvalstaff(this);" data-id="{{ $item->id }}" class="far fa-trash-alt"></i>
                                                    </td>
                                                @endforeach
                                                <td><button onclick="add_td(this);" type="button" class="btn btn-secondary btn-sm waves-effect waves-light">+</button></td>
                                            </tr>
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

<style>
    .relitve{
        position: relative;
    }
    .relitve i{
        position: absolute;
    top: 6px;
    right: 6px;
    background: #f5f5f5;
    padding: 5px;
    border-radius: 4px;
    color: #ddd;
    cursor: pointer;
    }
    .relitve i:hover{
        color: #cdcdcd;
    }
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
<script src="{{ asset('assets/libs/bootstrap-editable/js/index.js') }}"></script>
<script type="text/javascript">

function add_td(thiss){
    
var html3 = `


<td class="relitve">
    <label>
        <input type="checkbox" onChange="update_manger(this);" data-id='' >
        Direct manager
    </label>
    <div>
        <a class="inline-department" href="#" data-type="select" data-pk="new"   data-url="/update_approvalstaffs_employee" >Employee</a>
    </div>
    <div style="background: #ddd; padding: 5px; border-radius: 50px; margin: 6px 0px;">
        
    </div>
    <div>
        <a class="inline-department2" href="#" data-type="select" data-pk="new" data-url="/update_approvalstaffs_section" >Position</a>
    </div>
    <i onclick="delete_approvalstaff(this);" data-id="" class="far fa-trash-alt"></i>
</td>



`;

$(thiss).closest("td").before(html3);
up();
}

function update_manger(ee){
    var value = $(ee).is(":checked");
    var pk = $(ee).data("id");
    if(pk == ''){
        pk = "new";
    }
    $.get('/update_approvalstaffs_manger',{value,pk},function(e, e2){
        if(e2 == "success"){
            $(ee).data("id",e.id);
            $(ee).closest("td").find("i").data("id",e.id);
        }
    });
}

function delete_approvalstaff(ee){

    
    var pk = $(ee).data("id");
    if(pk == ''){
        $(ee).closest("td").fadeOut();
    }else{

        Swal.fire({
        title: lang ? "هل أنت متأكد؟" : "Are you sure?",
        text: lang ? "هل تريد الحذف فعلا" : "Do you really want to delete?",
        icon: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#1cbb8c",
        cancelButtonColor: "#f14e4e",
        confirmButtonText: lang ? "نعم إحذف !" : "Yes, delete it!",
        cancelButtonText: lang ? "إلغاء" : "Cancel",
    }).then(function(t) {
        if(t.value){
            $.get('/delete_approvalstaff',{pk},function(e){
            
        });
        $(ee).closest("td").fadeOut();
        }
    })
        
    }

    

    
}

    function up(){
        var data2 = "{{ $employees }}";
        var js = JSON.parse(data2.replace(/&quot;/g,'"'));

        $(".inline-department").editable({
            mode: "inline",
            inputclass: "form-control-sm",
            source: js
        });

        var data2 = "{{ $section }}";
        var js = JSON.parse(data2.replace(/&quot;/g,'"'));

        $(".inline-department2").editable({
            mode: "inline",
            inputclass: "form-control-sm",
            source: js
        });

    }

    up();
    </script>
@endsection

