<?php

namespace App\Http\Controllers;

use App\Nationality;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $permission = Permission::create(['name' => 'edit articles']);
        $user = auth()->user();
        //$user->givePermissionTo('edit articles');
        
        $nationalities = Nationality::where('company_id', auth()->user()->company->id)
        ->orderBy('id','DESC')
        ->get();

        return view('nationality.index',compact('nationalities'));
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

        $request->validate([
            'name_ar'=> ['required'],
            'name_en'=> ['required'],
        ]);

        $company_id = auth()->user()->company->id;
        $nationality = new Nationality();
        $nationality->name_ar = $request->name_ar;
        $nationality->name_en = $request->name_en;
        $nationality->company_id = $company_id;
        $nationality->save();
        return $nationality;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function show(Nationality $nationality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function edit(Nationality $nationality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'name_ar'=> ['required'],
            'name_en'=> ['required'],
        ]);

        $na = Nationality::findOrFail($request->nationality);
        if($na->company_id != auth()->user()->company->id){
            return;
        }
        $na->name_ar = $request->name_ar;
        $na->name_en = $request->name_en;
        $na->save();
        return $na;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nationality  $nationality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nationality $nationality)
    {
        //
    }
}
