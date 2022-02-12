<?php

namespace App\Http\Middleware;

use App\Company;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSettings
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

        $host = $request->getHttpHost();
        $ex = explode('.',$host);
        $subdomain = $ex[0];
        $company = Company::where('domain',$subdomain)->first();

        //dd(count($company->nationalitys));

        $false = false;
        if(count($company->nationalitys) == 0 or $company->extra_work == null or $company->month_calculator == null or $company->name_en == null or $company->name_ar == null){
            $false = true;
        }

        if(auth()->user()){
            if(auth()->user()->change_password && $request->getRequestUri() != "/edit_password"){
                return redirect('/edit_password')->with('warning',  __('Continue to use You must change your password Your own password'));
            }
        }

        if($false && $request->getRequestUri() != "/setting" && $request->getRequestUri() != "/nationality"){
            return redirect('/setting');
        }
        return $next($request);
    }
}
