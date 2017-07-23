<?php

namespace App;

use Moloquent\Eloquent\Model;


class Offer extends Model
{
    protected $dates = ['date'];

    protected $dateFormat = "Y-m-d";

    public function place()
    {
        return $this->belongsTo(Place::class, 'places_id');
    }
}
