<?php

namespace App\Http\Controllers;

use App\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    /**
     * Display a listing of the offers.
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function index($slug, Request $request)
    {
        if($request->ajax()) {

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

        return view('products', compact('products'));
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
