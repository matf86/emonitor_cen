<?php

namespace App\Filters;

use App\Log;
use Carbon\Carbon;


class LogsFilters extends Filters
{
    protected $filters = ['categories', 'dateRange'];

    protected function categories(array $value) {

//        if($value[0] === 'null') {
//            $value = Log::getCategories();
//        }

        return $this->builder->whereIn('category', $value);
    }

    protected function dateRange(array $value) {

        $dates = array_map(function($val) {
            return new Carbon($val);
        }, $value);

        $dates[1] = $dates[1]->addSeconds(86399);

        return $this->builder->whereBetween('created_at', $dates);
    }
}