<?php

namespace App\Http\Middleware;

use App\Centro;
use Closure;

class PrimerloginMiddleware
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

        if(count(Centro::all())<1){

            return redirect('/asistente');

        }

        return $next($request);

    }
}
