<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class peticionautenticada
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
        if(session('ID_Empleado') == ""){
             return redirect('');    
        }
        return $next($request);
    }
}
