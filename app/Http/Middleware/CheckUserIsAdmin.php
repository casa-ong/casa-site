<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserIsAdmin
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
        $admin = auth()->user()->admin;
        
        // Verifica se o user eh admin
        if ( $admin == false ){
            return redirect('/home')->with('error', 'Você não é administrador!');
        }
    
        return $next($request);
    }
}
