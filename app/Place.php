<?php

namespace App;

use Moloquent\Eloquent\Model;



class Place extends Model
{

    public function getIdAttribute($value)
    {
        if (!$value and array_key_exists('_id', $this->attributes)) {
            return $this->attributes['_id'];
        }

    }

}
