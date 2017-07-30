<?php

namespace App\Http\Middleware;

use Closure;

class ValidateDateRangeQueryString
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
        $paramsToValidate = ['minDate', 'maxDate'];

        $query = $request->query();

        if (!(array_key_exists("minDate", $query) AND array_key_exists("maxDate", $query))) return $next($request);

        $result = array_intersect_key( $query, array_flip($paramsToValidate));

        foreach ($result as $key => $value) {

            if(!preg_match("/^\d{4}-\d{2}-\d{2}$/", $value)) return response("Nieprawidłowy foramt parametru '{$key}'. Foramt wymagany: YYYY-MM-DD", 422);

        }

        return $next($request);

    }
}
