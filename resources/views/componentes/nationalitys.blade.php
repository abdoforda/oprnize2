

@foreach ($nationalities as $index => $item)

@if ($type == 2)
<label for="cl{{$index}}" class="choosse">
    <i class="fas fa-check-circle"></i>
    <span>{{ $item->name }}</span>
    <input id="cl{{$index}}" type="radio" class="hide" name="nationality_id" value="{{ $item->id }}">
</label>
@else

<label for="cl{{$index}}" class="choosse checkbox2_item">
    <i class="fas fa-check-circle"></i>
    <span>{{ $item->name }}</span>
</label>
<input id="cl{{$index}}" type="checkbox" class="hide" name="nationalities[]" value="{{ $item->id }}">

@endif
@endforeach

<div style="display: table; width: inherit; padding: 0;" class="append2"></div>

<button type="button" class="btn btn-secondary waves-effect waves-light" data-bs-toggle="modal"
    data-bs-target=".bs-example-modal-lg"
    style="display: table; width: 110px; border-radius: 50px; padding: 0px; height: 36px;">{{__('Add New')}} <i
        class="fas fa-plus"></i></button>

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
@endsection
@section('script2')
<script>
    $("body").on('click','.checkbox2_item',function(){
            console.log('asdasds');
            if ($(this).hasClass("clickable")) {
                $(this).removeClass("clickable");
                $(this).find("i").hide(0);
            }else{
                $(this).addClass("clickable");
                $(this).find("i").fadeIn();
            }
            
        });

        

    $(document).ready(function(e) {
   var domain = "{{ request()->getHost() }}";
   var check_type = "{{ $type }}";
            $(".ajax_nationality").ajaxForm({
                complete: function(data){
                    var mess = '';
                    if(data.status == 422){
                        for(let x in data.responseJSON.errors){
                            mess += "<p>"+data.responseJSON.errors[x][0]+"</p>";
                        }
                        $(".message").hide(0).html(mess).fadeIn();
                    }else if(data.status == 201){
                        if(check_type == 1){
                            $(".append2").append(`
                        
                        <label for="cl2${data.responseJSON.id}" class="choosse checkbox2_item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>${data.responseJSON.name_ar} - ${data.responseJSON.name_en}</span>
                                    </label>
                                    <input id="cl2${data.responseJSON.id}" type="checkbox" class="hide" name="nationalities[]" value="${data.responseJSON.id}">

                        `);
                        }else{
                            $(".append2").append(`<label for="cl2${data.responseJSON.id}" class="choosse">
    <i class="fas fa-check-circle"></i>
    <span>${data.responseJSON.name_ar} - ${data.responseJSON.name_en}</span>
    <input id="cl2${data.responseJSON.id}" type="radio" class="hide" name="nationality_id" value="${data.responseJSON.id}">
</label>`);
                        }
                        
                        $(".clcl").trigger('click');
                    }
                    
                }
            });

        });



</script>
@endsection