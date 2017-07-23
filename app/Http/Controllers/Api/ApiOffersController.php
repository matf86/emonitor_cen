<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Place;


class ApiOffersController extends Controller
{
    /**
     * Display a listing of the offers.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function index($slug, Request $request)
    {
        $place = Place::where('slug', $slug)->get()->toArray();


        if($request->query('date')) {

            $date = new \MongoDB\BSON\UTCDateTime(new \DateTime($request->query('date')));


            $products = Offer::where([
                ['date', '=', $date],
                ['places_id', '=', new \MongoDB\BSON\ObjectID($place[0]['_id'])]])->get()->toArray();


                if(!$products) {
                    return response('Brak danych dla wskazanej daty', 422);
                }

                return ['data' => ['products_list' => $products,
                                   'place_data' => $place]];
            }

        $latestDate = Offer::where('places_id', '=', new \MongoDB\BSON\ObjectID($place[0]['_id']))->orderBy('date', 'desc')->select('date')->first();

        $products = Offer::where([
            ['date', '=', $latestDate->date],
            ['places_id', '=', new \MongoDB\BSON\ObjectID($place[0]['_id'])]])->get();


        return ['data' => ['products_list' => $products,
            'place_data' => $place]];

    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $name, Request $request)
    {
        $place = Place::where('slug', $slug)->get()->toArray();

        if($request->query('minDate') && $request->query('maxDate')) {

            $minDate = new \MongoDB\BSON\UTCDateTime(new \DateTime($request->query('minDate')));
            $maxDate = new \MongoDB\BSON\UTCDateTime(new \DateTime($request->query('maxDate')));


            $products = Offer::where([
                ['product', '=', $name],
                ['places_id', '=', new \MongoDB\BSON\ObjectID($place[0]['_id'])]
            ])->whereBetween('date', [$minDate, $maxDate])
            ->orderBy('date', 'asc')->get();

            return ['data' => ['products_list' => $products]];
        }

        $products = Offer::where([
            ['product', '=', $name],
            ['places_id', '=', new \MongoDB\BSON\ObjectID($place[0]['_id'])]
        ])->orderBy('date', 'asc')->get();


        return ['data' => ['products_list' => $products]];
    }
}
