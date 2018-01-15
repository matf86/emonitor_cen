<?php

namespace App;

use Moloquent\Eloquent\Model;

class Log extends Model
{
    protected $dates = ['created_at'];

    protected $dateFormat = 'Y-m-d';

    /**
     * Get offers relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    /**
     * Query scope for offers filters.
     *
     * @param $query
     * @param $filters
     *
     * @return mixed
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
