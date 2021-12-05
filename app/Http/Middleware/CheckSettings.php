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

        if($company->extra_work == null && $request->getRequestUri() != "/setting"){
            return redirect('/setting');
        }
        return $next($request);
    }
}
