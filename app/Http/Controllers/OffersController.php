<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;

class OffersController extends Controller
{
    /**
     * Display a listing of the offers.
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function index($slug, Request $request, Place $place)
    {
        $place = $place->getPlaceBySlug($slug);

        if($place->isEmpty()) {
            return response()->redirectToRoute('home')
                ->with('page-not-found', "Brak podstrony dla adresu: ". $request->fullUrl());
        }

        return view('products');
    }

}
