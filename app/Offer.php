<?php

namespace App;

use Moloquent\Eloquent\Model;
use Illuminate\Support\Facades\Cache;


class Offer extends Model
{
    protected $dates = ['date'];

    protected $dateFormat = "Y-m-d";

    public function place()
    {
        return $this->belongsTo(Place::class, 'places_id');
    }

    public function scopeByDate($query, $date, $placeId)
    {
        return $query->where([
            ['date', '=', $date],
            ['places_id', '=', $placeId]
        ]);
    }

    public function scopeOrderByDate($query, $placeId)
    {
        return $query->where('places_id', '=', $placeId)
                     ->orderBy('date', 'desc');
    }

    public function scopeByProductName($query, $name, $placeId)
    {
        return $query->where([
            ['product', '=', $name],
            ['places_id', '=', $placeId]
        ]);
    }

    public function getOfferByDate($slug, $date, $placeId) {

        return Cache::remember($date.'-'.$slug.'-offer', 10080 ,function () use ($date, $placeId) {
            return  $this->byDate($date, $placeId)->get();
        });
    }

    public function getProductInTimeRange($name, $placeId, $dateRangeStartpoint, $dateRangeEndpoint) {

        return  $this->byProductName($name, $placeId)
            ->whereBetween('date', [$dateRangeStartpoint, $dateRangeEndpoint])
            ->orderBy('date', 'asc')
            ->get();
    }

    public function getLatestDate($placeId) {

        return $this->orderByDate($placeId)->first()->date;
    }

}
