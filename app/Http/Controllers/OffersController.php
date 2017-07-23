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
    public function index($slug, Request $request)
    {
        $place = Place::where('slug', $slug)->get()->toArray();

        if(count($place) == 0) {
            return response()->redirectToRoute('home')->with('page-not-found', "Brak podstrony dla adresu: ". $request->fullUrl());
        }

        return view('products');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
