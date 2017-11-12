<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOffer;
use App\Http\Requests\StoreOffer;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectID;
use Carbon\Carbon;
use App\Offer;

class OffersController extends Controller
{
    /**
     * Remove the specified offers from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Offer::whereIn('_id', $request->get('ids'))->delete();

        return response()->json(['status' => 'success'], 200);
    }


    /**
     * Add new offer to storage.
     *
     * @param StoreOffer $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOffer $request)
    {
        $offer = Offer::create([
            'product' => $request->get('product'),
            'type' => $request->get('type'),
            'origin' => $request->get('origin'),
            'package' => $request->get('package'),
            'market_id' => new ObjectID($request->get('market_id')),
            'price_min' => $request->get('price_min'),
            'price_max' => $request->get('price_max'),
            'date' => new Carbon($request->get('date')),
         ]);

    return response()->json(['data' => $offer],200);
    }


    /**
     * Update existing offer.
     *
     * @param $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateOffer $request)
    {
        Offer::where('_id', new ObjectID($id))->update([
            'origin' => $request->get('origin'),
            'package' => $request->get('package'),
            'price_min' => $request->get('price_min'),
            'price_max' => $request->get('price_max'),
            'product' => $request->get('product'),
            'type' => $request->get('type'),
        ]);

        return response()->json(['data' => Offer::find(new ObjectID($id))],200);
    }


    /**
     * Display a listing of offers types.
     *
     * @param Offer $offer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexTypes(Offer $offer) {
        $types = $offer->getTypes();

        return response()->json(['data' => $types],200);
    }

    /**
     * Display a listing of offers origins.
     *
     * @param Offer $offer
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexOrigins(Offer $offer) {
        $origins = $offer->getOrigins();

        return response()->json(['data' => $origins],200);
    }
}
