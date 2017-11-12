<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexOffersStats;
use App\Offer;


class OffersStatsController extends Controller
{
    /**
     * Display a listing of offers statistic.
     *
     * @param Offer $offer
     * @param IndexOffersStats $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Offer $offer, IndexOffersStats $request)
    {
        $data = $offer->countByDateAndMarket($request->get('markets'), $request->get('dateRange'));

        return response()->json(['status' => (count($data) === 0) ? 'no data': 'success', 'data' => $data], 200);
    }
}
