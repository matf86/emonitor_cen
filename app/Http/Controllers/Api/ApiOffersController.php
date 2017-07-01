<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;


class ApiOffersController extends Controller
{
    /**
     * Display a listing of the offers.
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function index($slug, Request $request)
    {
            if($request->query('date')) {

                $date = new \MongoDB\BSON\UTCDateTime(new \DateTime($request->query('date')));


                $products = Offer::where([
                    ['slug', '=', $slug],
                    ['date', '=', $date]
                ])->get()->toArray();


                if(!$products) {
                    return response('Brak danych dla wskazanej daty', 422);
                }

                return $products;
            }


            $latestDate = Offer::orderBy('date', 'desc')->select('date')->first();


            $products = Offer::where([
                ['slug', '=', $slug],
                ['date', '=', $latestDate->date]
            ])->get();

            return $products;
    }
}
