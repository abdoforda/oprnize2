<div class="row">
    <div class="col-12">
       
        <div class="card">
            
            <form class="ajax_request" action="/request" method="POST">
                @csrf
                <input type="hidden" name="model" value="vacation">
                <input type="hidden" class="vacation_id" name="vacation_id" >
                <div class="card-body">

                    <h4 class="header-title">طلب أجازة</h4>
                    <p class="card-title-desc">
                        أطلب أجازتك الأن
                    </p>
    
                    @if (auth()->user()->employee)
                    <label class="form-label choose_vacation_type">{{__('Vacations')}}</label>
                    <div  class="button-items choose_vacation_type">
                        @foreach (auth()->user()->company->vacations as $item)
                        
                        @php $check = false; @endphp
    
                        @if ($item->type == "all")
                            @php $check = true; @endphp
                        @endif
    
                        @if (auth()->user()->employee->gender == $item->type)
                            @php $check = true; @endphp
                        @endif
    
                        @if ($check)
                        
                        <button onclick="leave({{ $item }})" type="button" class="btn btn-outline-secondary waves-effect waves-light">{{ $item->name }}</button>
    
                        @endif
                        
                        @endforeach
                    </div>
                    @else
                    <div class="alert alert-primary" role="alert">
                        {{ __('Sorry, as the founder of the company, you do not have the right to request a vacation') }}
                    </div>
                    @endif
    
    
                    <div class="hide">
                        <div class="row">
                            
                            <div class="col-5">
                                <div class="input-group">
                                    <label class="form-label">{{ __('Holiday start and end date') }}</label>
                                    <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                        <input type="text" class="form-control" name="start" data-dd="dater" placeholder="{{ __('Start Date') }}" />
                                        <input type="text" class="form-control" name="end" data-dd="dater" placeholder="{{ __('End Date') }}" />
                                        <span></span>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-5 type_annual">
    
                                <div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="pay_in_advance" value="pay_in_advance" id="formRadios1">
                                        <label class="form-check-label" for="formRadios1">
                                            {{ __('Pay in advance') }}
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="pay_in_advance" value="pay_with_payroll" id="formRadios2">
                                        <label class="form-check-label" for="formRadios2">
                                            {{ __('Pay with payroll') }}
                                        </label>
                                    </div>
                                </div>
    
                                <div>
                                <input type="checkbox" id="switch4" name="visa" switch="success" />
                                <label class='lable_lang' for="switch4" data-on-label="{{ __('Yes') }}" data-off-label="{{ __('No') }}"></label>
                                    {{ __('Visa') }}
                                </div>
                                <br />
                            <div>
                                <input type="checkbox" id="switch5" name="ticket" switch="success" />
                                <label class='lable_lang' for="switch5" data-on-label="{{ __('Yes') }}" data-off-label="{{ __('No') }}"></label>
                                {{ __('Ticket') }}
                            </div>
    
                            </div>
                            
                            <div class="col-2">
                                {{ __('Current Balance') }}<br />
                                {{ number_format(auth()->user()->employee->current_balance(), 2) }}
                            </div>
    
                    </div>
                    
                    <br />
                    <div class="row">
                        <div class="button-items">
                            <button type="submit" class="btn btn-primary waves-effect waves-light" >{{ __('Sent') }}</button>
                        </div>
                    </div>
                    
                </div>
            </form>

            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        </div>

    </div>
    <!-- end Col-9 -->

</div>

<style>
    .hide{
        display: none;
    }
</style>

<script>
    function leave(json){

        $(".type_annual").hide();
        $(".vacation_id").val(json.id);
        $(".choose_vacation_type").fadeOut(500);
        $(".hide").delay(500).fadeIn();

        if(json.type2 == "annual"){
            $(".type_annual").delay(500).fadeIn();
        }

    }

    $(document).ready(function(e) {
   var domain = "{{ request()->getHost() }}";
   $(".ajax_request").ajaxForm({
    beforeSend : function(){
                    $(".invalid-feedback").remove();
                    $(".is-invalid").removeClass("is-invalid");
                },
                complete: function(data){
                    var mess = '';
                    if(data.status == 422){
                        error_message(data.responseJSON.message);
                        errors(data.responseJSON.errors);
                    }else if(data.status == 201){
                        Success("{{ __('Your request has been sent') }}");
                        window.location.href = "/request";
                    }else if(data.status == 200){
                        toast_message("asd",'ddd','ok');
                    }
                    
                }
            });

        });

</script>


@if (app()->getLocale() == "ar")
<style>
    .lable_lang{
        float: right; margin-left: 7px;
    }
</style>
    @else
    <style>
        .lable_lang{
            float: left; margin-right: 7px;
        }
    </style>
    @endif

