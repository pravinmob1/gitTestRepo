<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TestParaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if ($roles == 'Pravin') {
            return $next($request);
        } else {
            return response()->json([
                'User' => $roles,
                'Error'=>'Invalid Name',
            ]);
        }
        
    }
}
