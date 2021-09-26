<?php

namespace App\Http\Middleware;

use Sentinel;
use Closure;
use Session;

class AdminSessionMiddleware
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
        if(Sentinel::check()){
            if($user = Sentinel::getUser()->permissions['admin']){
                return $next($request);
            }else{
                \Session::flash('success_authenticate', 'Anda tidak punya akses ke url tersebut!');
                return redirect()->back();
            }
        }else{
                  \Session::flash('success_authenticate', 'Anda tidak punya akses ke url tersebut!');
                return redirect()->back();
        }
    }
}
