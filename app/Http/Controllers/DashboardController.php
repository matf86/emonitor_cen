<?php


namespace App\Http\Controllers;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOffers()
    {
        return view('dashboard.offers');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMarkets()
    {
        return view('dashboard.markets');
    }
}
