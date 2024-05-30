<?php

namespace App\Http\Middleware;

use Closure;

class HandleFormData
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
        if ($request->isMethod('put') || $request->isMethod('patch')) {
            if ($request->has('formData')) {
                $request->merge(json_decode($request->formData, true));
            }
        }

        return $next($request);
    }
}