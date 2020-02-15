<?php

namespace App\Http\Middleware;

use Closure;

class Localization
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
        if ($user = $request->user()) {
            if ($user->locale !== 'en') {
                app()->setLocale('ar');
            }
        } else {
            if (! empty(session('locale'))) {
                app()->setLocale(session('locale'));
            }
        }

        return $next($request);
    }
}
