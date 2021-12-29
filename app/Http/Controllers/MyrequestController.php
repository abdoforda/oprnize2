<?php

namespace App\Http\Controllers;

use App\Myrequest;
use App\Myvacation;
use App\Vacation;
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
