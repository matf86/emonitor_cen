<?php

namespace App\Http\Controllers;

use App\Market;

class MarketsController extends Controller
{
    /**
     * Display a listing of available markets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $markets = Market::all();

        if(request()->ajax()) {
            return response()->json($markets,200);
        }

        return view('front.home', compact('markets'));
    }

    /**
     * Display the specified market.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market)
    {
        return view('front.market', compact('market'));
    }
}
