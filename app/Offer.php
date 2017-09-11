<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use App\Exceptions\EmptyResourceException;
use Moloquent\Eloquent\Model;


class Offer extends Model
{
    protected $dates = ['date'];

    protected $guarded = [];

    protected $dateFormat = "Y-m-d";

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }


    public function getProductInTimeRange($name, $placeId, $dateRangeStartPoint, $dateRangeEndpoint) {

        $offers = $this->where([['product', '=', $name],['place_id', '=', $placeId]])
            ->whereBetween('date', [$dateRangeStartPoint, $dateRangeEndpoint])
            ->orderBy('date', 'asc')->get();

        if($offers->count() == 0) {
            throw new EmptyResourceException('Brak danych dla wskazanego przedziału dat.');
        }

        return $offers;

    }

    public function getByDate($slug, $placeId, $date) {

        return Cache::rememberForever($slug.'-'.$date->toDateString(), function() use($date, $placeId) {

            $offers = $this->where([
                ['date', '=', $date],
                ['place_id', '=', $placeId]
            ])->get();

            if($offers->count() == 0) {
                throw new EmptyResourceException('Brak danych dla wskazanej daty.');
            }

            return $offers;
        });
    }

    public function getLatestDate($placeId) {

        return $this->where('place_id', '=', $placeId)->orderBy('date', 'desc')->first()->date;
    }

    public function distinctEntriesInTimeRange(array $placeId, $dateRangeStartPoint, $dateRangeEndpoint) {

        $min = new \MongoDB\BSON\UTCDateTime($dateRangeStartPoint);
        $max = new \MongoDB\BSON\UTCDateTime($dateRangeEndpoint);

        return $this->raw(function($collection) use ($placeId, $min, $max)
        {
            return $collection->aggregate([
                ['$match' => ['$and' => [['place_id' => ['$in' => $placeId]], ['date' => [ '$gte' => $min, '$lte' => $max ]]]]],
                ['$lookup' => ['from' => 'places','localField' => 'place_id','foreignField' => '_id', 'as' => 'place']],
                ['$unwind' => '$place'],
                ['$project' => [ "_id" => 0, "product" => 1, "date" => 1, "place_id" => 1, "place_name" => '$place.name' ]],
                ['$group' => ['_id' => [ 'date' => '$date', 'place_name' => '$place_name', 'place_id' => '$place_id'], 'count' => [ '$sum' => 1 ]]]
            ]);
        });
    }

}
