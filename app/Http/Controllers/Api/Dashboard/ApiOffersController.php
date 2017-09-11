<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Offer;
use App\Place;
use App\Services\OfferService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MongoDB\BSON\ObjectID;
use MongoDB\Driver\Exception\InvalidArgumentException;

class ApiOffersController extends Controller
{
    public function index(Request $request) {
        if(($request->query('id') && $request->query('date'))) {

            $results = Offer::where([
                'date' => new Carbon($request->query('date')),
                'place_id' => new ObjectID($request->query('id'))
            ])->get();

            return response()->json(['data' => ['offers' => $results]],200);
        }
        return response()->json(['data' => 'Wystąpił błąd, prosze spróbowac puźniej.'], 402);
    }

    public function store(Request $request) {
        // Dodaj validacje

        $offer = Offer::create([
            'product' => $request->get('product'),
            'type' => $request->get('type'),
            'origin' => $request->get('origin'),
            'package' => $request->get('package'),
            'place_id' => new ObjectID($request->get('place_id')),
            'price_min' => $request->get('price_min'),
            'price_max' => $request->get('price_max'),
            'date' => new Carbon($request->get('date')),
        ]);

        return response()->json(['data' => $offer, 'type' => 'update'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function showDistinctEntries(Request $request)
    {
        try {
            $placeIds = $this->setPlaceIds($request);

        } catch(InvalidArgumentException $exception) {

            return response()->json(['data' => ['entries_list' => []]]);
        }

        $result = app()->make(OfferService::class)
            ->getDistinctEntriesInTimeRange($placeIds, $request->query('minDate'), $request->query('maxDate'));

        return response()->json(['data' => ['entries_list' => $result]]);
    }

    public function destroy(Request $request) {
        if(($request->query('id') && $request->query('date'))) {

            Offer::where([
               'date' => new Carbon($request->query('date')),
               'place_id' => new ObjectID($request->query('id'))
            ])->delete();

           return response()->json(['data' => 'Operacja usunięcia wpisów zakonczyła sie powodzeniem'],200);
        }
        return response()->json(['data' => 'Operacja usunięcia wpisów zakonczyła sie niepowodzeniem'], 402);
    }

    public function destroySelected(Request $request) {

        $idsToDelete = $request->get('ids');
        $place_id = $request->get('place_id');
        $date = $request->get('date');


        Offer::whereIn('_id', $idsToDelete)->delete();

        $results = Offer::where([
            'date' => new Carbon($date),
            'place_id' => new ObjectID($place_id)
        ])->get();

        return response()->json(['msg' => 'Operacja usunięcia wpisów zakonczyła sie powodzeniem',
                                'data' => $results,
                                'type' => 'delete'],200);
    }

    public function update($id, Request $request) {

       $data = $request->all();

       Offer::where('_id', new ObjectID($id))->update([
            'origin' => $data['origin'],
            'package' => $data['package'],
            'price_min' => $data['price_min'],
            'price_max' => $data['price_max'],
            'product' => $data['product'],
            'type' => $data['type']
        ]);

       return response()->json(['data' => Offer::find(new ObjectID($id)), 'type' => 'update'],200);
    }

    protected function setPlaceIds($request) {

        if(!$request->query('id')) {
            return Place::all()->pluck('id')->toArray();
        }

        return array_map(function($item) { return new ObjectID($item);}, $request->query('id'));

    }

}
