<?php

namespace App;

use Moloquent\Eloquent\Model;

class Market extends Model
{
    protected $dates = ['date'];

    protected $appends = ['count_offers', 'latest_offer'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get offers relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    /**
     * Get offers relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function getCountOffersAttribute()
    {
        return $this->offers()->count();
    }

    public function getLatestOfferAttribute()
    {
        $date = $this->offers()->max('date');

       return  $this->asDateTime($date)->format('Y-m-d');
    }

    /**
     * Get date of latest offer for given market.
     *
     * @return mixed
     */
    public function getLatestOfferDate()
    {
        return $this->offers()->max('date');
    }


    /**
     * Get number of offers for given date.
     *
     * @param $date
     *
     * @return mixed
     */
    public function getOffersCount($date)
    {
        return $this->offers()->where('date', $date)->count();
    }

}
