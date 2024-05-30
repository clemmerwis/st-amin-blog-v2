<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConvertNullStringMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();

        array_walk_recursive($input, function (&$value) {
            if ($value === 'null') {
                $value = null;
            }
        });

        $request->merge($input);

        return $next($request);
    }
}