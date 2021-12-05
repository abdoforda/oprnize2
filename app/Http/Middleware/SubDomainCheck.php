<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class SubDomainCheck
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


        if($request->getRequestUri() == "/register"){
            return redirect('404');
        }
        
        $host = $request->getHttpHost();
        $ex = explode('.',$host);
        $subdomain = $ex[0];
        $user = User::where('domain',$subdomain)->first();
        if($user){
            session()->flash('domain', $subdomain);
            return $next($request);
        }
        return redirect('404');
    }
}
