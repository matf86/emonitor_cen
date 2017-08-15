<?php

namespace App\Http\Controllers\Api;


use App\Services\OfferService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $placeData = Place::whereSlug($slug)->firstOrFail();

        $products = app()->make(OfferService::class)
            ->getOffersByDate($slug, $placeData->id, $request->query('date'));

        return response()->json(['data' => ['products_list' => $products,
                                            'place_data' => $placeData]]);
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
        $placeData = Place::whereSlug($slug)->firstOrFail();

        $products = app()->make(OfferService::class)
            ->getOffersForProductInTimeRange($name, $placeData->id, $request->query('minDate'), $request->query('maxDate'));

        return response()->json(['data' => ['products_list' => $products]]);
    }

}
