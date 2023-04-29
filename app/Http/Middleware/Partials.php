<?php

namespace App\Http\Middleware;

use Closure;
use ATPGroup\Settings\Models\Setting;

class Partials
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
        $data['setting'] = Setting::pluck('setting_value', 'setting_key');
        
        view()->share($data);
        return $next($request);
    }
}
