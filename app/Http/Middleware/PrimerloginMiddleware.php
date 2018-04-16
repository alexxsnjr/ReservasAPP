<?php

namespace App\Http\Middleware;

use App\Ies;
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

        if(count(Ies::all())<1){

            return redirect('/asistente');

        }

        return $next($request);

    }
}
