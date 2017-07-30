<?php

namespace App\Http\Controllers\Api;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Place;


class ApiOffersController extends Controller
{
    protected $place;
    protected $offer;
    /**
     * ApiOffersController constructor.
     */
    public function __construct(Place $place, Offer $offer)
    {
        $this->place = $place;
        $this->offer = $offer;
    }


    /**
     * Display a listing of the offers.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function index($slug, Request $request)
    {
        $place_data = $this->place->getPlaceBySlug($slug);

        $placeId = $this->generateMongoId($place_data[0]->id);

        $date = $this->setDate($request->query('date'), $placeId);

        $products = $this->offer->getOfferByDate($slug, $date, $placeId);

        if($products->isEmpty()) {
            return response('Brak danych dla wskazanej daty', 422);
        }

        return ['data' => ['products_list' => $products,
                'place_data' => $place_data[0]]];
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
        //$placeData = $this->placeService->findBySlug($slug);
        //$products = $this->offerService->getProductsForTimeRange($name, $placeId, $dateRange);


        $place_data = $this->place->getPlaceBySlug($slug);

        $placeId = $this->generateMongoId($place_data[0]->id);

        $dateRange = $this->setDateRange($request->query('minDate'),$request->query('maxDate'), $placeId);

        $products = $this->offer->getProductInTimeRange($name, $placeId, $dateRange['timeStartPoint'], $dateRange['timeEndPoint']);

        if($products->isEmpty()) {
            return response('Brak danych dla wskazanego przedziału dat', 422);
        }

        return ['data' => ['products_list' => $products]];

    }

    protected function generateMongoId($value) {
        return new \MongoDB\BSON\ObjectID($value);
    }

    protected function setDate($date, $placeId) {
        return ($date)? new Carbon($date): $this->offer->getLatestDate($placeId);
    }

    protected function setDateRange($minDate = null , $maxDate = null, $placeId) {

        $timeEndPoint = ($maxDate)? new Carbon($maxDate) : $this->offer->getLatestDate($placeId);

        $timeStartPoint = ($minDate)? new Carbon($minDate) : $timeEndPoint->copy()->subMonth();

        return [
            'timeEndPoint' => $timeEndPoint,
            'timeStartPoint' => $timeStartPoint,
            ];
    }
}
