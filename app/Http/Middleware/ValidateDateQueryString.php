<?php

namespace App\Http\Middleware;

use Closure;

class ValidateDateQueryString
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
        $query = $request->query();

        if(!array_key_exists('date', $query)) return $next($request);


        if(preg_match("/^\d{4}-\d{2}-\d{2}$/", $query['date'])) return $next($request);


        return response("Nieprawidłowy foramt parametru 'date'. Foramt wymagany: YYYY-M-DD", 422);
    }


}
