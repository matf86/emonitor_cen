<?php
namespace App\Filters;

use Carbon\Carbon;

class OfferFilters extends Filters
{
    protected $filters = ['date', 'dateRange', 'product', 'origin', 'package'];

    protected function product($value) {
        return $this->builder->where('product', $value);
    }

    protected function package($value) {
        return $this->builder->where('package', $value);
    }

    protected function origin($value) {
        return $this->builder->where('origin', $value);
    }

    protected function date($value) {
        return $this->builder->where('date', new Carbon($value));
    }

    protected function dateRange(array $value) {

        $dates = array_map(function($val) {
            return new Carbon($val);
        }, $value);

        return $this->builder->whereBetween('date', $dates);
    }
}