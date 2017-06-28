<?php

namespace App;

use Moloquent\Eloquent\Model;


class Offer extends Model
{
    protected $dates = ['date'];

    protected $dateFormat = "Y-m-d";
}
