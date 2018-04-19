<?php

namespace App\Http\Middleware;

use App\Centro;
use Closure;

class AsistenteMiddleware
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
        if (count(Centro::all())>=1) {

            return redirect('/admin')->with('danger', 'No es posible acceder a estra sección');

        }

        return $next($request);
    }
}
