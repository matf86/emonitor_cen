<?php

namespace App;

use Moloquent\Eloquent\Model;
use Illuminate\Support\Facades\Cache;


class Place extends Model
{

    public function getPlaceBySlug($slug) {
        return Cache::rememberForever('place-'.$slug, function () use ($slug) {
            return $this->whereSlug($slug)->get();
        });
    }
}
