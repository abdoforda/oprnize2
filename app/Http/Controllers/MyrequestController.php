<?php

namespace App\Http\Controllers;

use App\Approvalstaff;
use App\Myrequest;
use App\Myvacation;
use App\Vacation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MyrequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nationalities = auth()->user()->employee->requests;
        return view('request.index', compact(['nationalities']));

    }

    public function requestemployees(){
        $nationalities = auth()->user()->employee->requests_employees;
        return view('request.requestemployees', compact(['nationalities']));
    }

    public function update_request(Request $request){
        
        $req = Myrequest::find($request->id);
        if($req->show_employee == auth()->user()->employee->id){

            $last = auth()->user()->company->approvalstaffs->last();

            if($request->status == "cancel"){
                $req->status = 'reject';
                $req->save();
                return "ok";
            }

            if($last->employee_id == auth()->user()->employee->id){
                $req->status = 'success';
                $req->save();
                return "ok";
            }

            $em_app = auth()->user()->employee->approvalstaff;
            $next = Approvalstaff::where([
                ['id', '>', $em_app->id],
                ['company_id', auth()->user()->company->id],
            ])->min('id');

            $next = Approvalstaff::find($next);

            $req->show_employee = $next->employee_id;
            $req->save();
            return "ok";

        }
    }

    public function view(Request $request){
        if($request->typee == "leave"){
            return view('request.leave');
        }
        return $request->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('request.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'model'=> Rule::in(['vacation','overtime']),
        ]);
        
        // فحص الطلب ونوعة
        if($request->model == "vacation"){

            $request->validate([
                'start'=> ['required'],
                'end'=> ['required'],
                'vacation_id'=> ['required'],
            ]);
            
            $start = date("Y-m-d", strtotime($request->start));
            $end = date("Y-m-d", strtotime($request->end));


            $vacation = Vacation::findOrFail($request->vacation_id);
            if($vacation){
                if($vacation->type2 == "annual"){
                    $request->validate([
                        'pay_in_advance'=> ['required',Rule::in(['pay_with_payroll','pay_in_advance'])],
                    ]);
                }


                $date = Carbon::parse($start);
                $now = Carbon::parse($end);
                $diff = $date->diffInDays($now)+1;

                if($diff > auth()->user()->employee->current_balance()){
                    return __('Your balance is not enough to request a vacation');
                }

                if($vacation->min == 0 and $vacation->max == 0){}else{
                    if($diff >= $vacation->min and $diff <= $vacation->max){}else{
                        return __('The number of vacation days should not be less than')." ".$vacation->min." ".__('and not more than')." ".$vacation->max;
                    }
                }


                // insert request vacation

                

                $company_id = auth()->user()->company->id;
                $myvacation = new Myvacation();
                $myvacation->company_id = $company_id;
                $myvacation->employee_id = auth()->user()->employee->id;
                $myvacation->vacation_id = $request->vacation_id;
                $myvacation->start = $start;
                $myvacation->end = $end;
                $myvacation->pay_in_advance = $request->pay_in_advance;
                $myvacation->visa = $request->has('visa');
                $myvacation->ticket = $request->has('ticket');
                $myvacation->save();

                $myrequest = new Myrequest();
                $myrequest->company_id = $company_id;
                $myrequest->employee_id = auth()->user()->employee->id;
                $myrequest->type = "leave";
                $myrequest->model_id = $myvacation->id;
                $myrequest->show_employee = auth()->user()->company->approvalstaffs->first()->employee_id;
                $myrequest->save();

                return $myrequest;

            }
            

            return "error";

        } // vacation

        return $request->toArray();
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Myrequest  $myrequest
     * @return \Illuminate\Http\Response
     */
    public function show(Myrequest $myrequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Myrequest  $myrequest
     * @return \Illuminate\Http\Response
     */
    public function edit(Myrequest $myrequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Myrequest  $myrequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Myrequest $myrequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Myrequest  $myrequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Myrequest $myrequest)
    {
        //
    }
}
