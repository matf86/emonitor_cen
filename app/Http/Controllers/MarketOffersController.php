<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteMarketOffers;
use App\Http\Requests\IndexMarketOffers;
use App\Filters\OfferFilters;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Market;

class MarketOffersController extends Controller
{

    /**
     * Display a listing of offers for given market.
     *
     * @param Market $market
     * @param Request $request
     * @param OfferFilters $filters
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Market $market, IndexMarketOffers $request, OfferFilters $filters)
    {

        if($request->query()) {
            $offers = $market->offers()
                ->filter($filters)
                ->orderBy('product')
                ->orderBy('date')
                ->get();

            return response()->json(['status' => (count($offers) === 0) ? 'no data': 'success', 'data' => $offers], 200);
        }
            $offers = $market->offers()
                ->where('date',  $market->getLatestOfferDate())
                ->orderBy('product')
                ->orderBy('date')
                ->get();

        return response()->json(['status' => (count($offers) === 0) ? 'no data': 'success', 'data' => $offers], 200);
    }

    /**
     * Remove all the offers from specified market for given date.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Market $market, DeleteMarketOffers $request)
    {
        $market->offers()
            ->where('date', new Carbon($request->get('date')))
            ->delete();

        return response()->json(['status' => 'success'], 200);
    }

}
