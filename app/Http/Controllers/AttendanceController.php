<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::today();
        $attendance = Attendance::all();
        return view('attendance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $date = Carbon::parse($request->attendance);
        $employees = Employee::all();
        $employees = $employees->map(function($employee) use ($date){
            
            $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', $date)->first();

            return [
                'employee' => $employee,
                'attendance' => $attendance
            ];
        });
        return $employees;
    }

    public function update_attendances(Request $request){

        $request->validate([
            'type' => Rule::in(['start','end']),
            'timee' => ['required'],
            'employee' => ['required'],
            'date' => ['required'],
        ]);


        $date = Carbon::parse($request->date);
        $attendance = Attendance::where('employee_id',$request->employee)
        ->whereDate('date', $date)->first();

        if($attendance){
            $attendance->{$request->type} = $request->timee;
            $attendance->save();
            return "ok2";
        }

        $company_id = auth()->user()->company->id;
        $attendance = new Attendance();
        $attendance->company_id = $company_id;
        $attendance->employee_id = $request->employee;
        $attendance->date = Carbon::parse($request->date);
        $attendance->{$request->type} = $request->timee;
        $attendance->save();
        
        return "ok";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
