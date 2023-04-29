<?php

namespace App\Http\Middleware;

use Closure;

class SetAPILocale
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
        if (!$request->headers->has('Locale')) {
            return responseErrorMessage('The Locale not found');
        }

        if ($request->header('Locale') == '') {
            return responseErrorMessage('Set a value in Locale like ar or en');
        }

        if (strlen($request->header('Locale')) > 2) {
            return responseErrorMessage('The Locale may not be greater than 2 characters.');
        }

        app()->setLocale($request->header('Locale'));

        $response = $next($request);
        return $response;
    }
}
