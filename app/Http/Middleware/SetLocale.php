<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class SetLocale
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
        if ($request->filled('setLanguage')) {
            app()->setLocale($request->setLanguage);
            session()->put('language', $request->setLanguage);
        }

        $currentLangauge = app()->getLocale();
        if (session()->has('language')) {
            $currentLangauge = session('language');
            app()->setLocale($currentLangauge);
        }

        $currentLangauge = DB::table('languages')->where('symbol', app()->getLocale())->first();
        if (!$currentLangauge) {
            $currentLangauge = DB::table('languages')->first();
        }
        $languages = DB::table('languages')->where('symbol', '!=', app()->getLocale())->get();

        view()->share(['languages' => $languages, 'currentLangauge' => $currentLangauge, 'textDirection' => ($currentLangauge->direction == 'rtl') ? '-rtl' : '']);
        return $next($request);
    }
}
