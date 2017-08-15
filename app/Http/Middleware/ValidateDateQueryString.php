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

        $pattern = '^(((((1[26]|2[048])00)|[12]\d([2468][048]|[13579][26]|0[48]))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|[12]\d))))|((([12]\d([02468][1235679]|[13579][01345789]))|((1[1345789]|2[1235679])00))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|1\d|2[0-8])))))$';

        $query = $request->query();

        if(!array_key_exists('date', $query)) return $next($request);


        if(preg_match("/$pattern/", $query['date'])) return $next($request);


        return response("Nieprawidłowa wartość parametru 'date'. Wymagana prawidłowa data w foramacie: YYYY-M-DD", 422);
    }


}
