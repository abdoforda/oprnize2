<?php

namespace App\Http\Middleware;

use App\Department;
use App\Job;
use App\Section;
use Closure;

class DeSeJo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->getRequestUri() == "/employee"){
            $de = Department::all();
            $se = Section::all();
            $jo = Job::all();

            if(count($de) == 0){
                return redirect('/department')->with('warning', __('You must add departments first, and you will be redirected to the Add Departments page'));
            }
            if(count($se) == 0){
                return redirect('/section')->with('warning', __('Sections must be added first and then add job titles, you are now on the Sections page, add them now'));
            }
            if(count($jo) == 0){
                return redirect('/job')->with('warning', __('You must add job titles first and then add employees, you are now on the job titles page, add them now'));
            }
        }

        if($request->getRequestUri() == "/section"){
            $de = Department::all();
            if(count($de) == 0){
                return redirect('/department')->with('warning', __('You must add departments first, and you will be redirected to the Add Departments page'));
            }
        }

        if($request->getRequestUri() == "/job"){
            $de = Department::all();
            $se = Section::all();
            if(count($de) == 0){
                return redirect('/department')->with('warning', __('You must add departments first, and you will be redirected to the Add Departments page'));
            }
            if(count($se) == 0){
                return redirect('/section')->with('warning', __('Sections must be added first and then add job titles, you are now on the Sections page, add them now'));
            }
        }

        return $next($request);

    }
}
