<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $rols
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $data = [];

        if ($request->name != 'Pravin') {
            $data['Error'][] = 'Name not match';
            //return redirect('/');
        }
        if ($request->id != 2) {
            $data['Error'][] = 'Id Missmatch';
        }
        if (count($data) > 0) {
            return response()->json($data);
        }
        return $next($request);
    }
}
