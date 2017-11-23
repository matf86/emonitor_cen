<?php

namespace App;

use Illuminate\Support\Collection;
use Moloquent\Eloquent\Model;

/**
 * Class Offer
 *
 * @package App
 */
class Offer extends Model
{
    protected $dates = ['date'];

    protected $dateFormat = 'Y-m-d';

    protected $guarded = [];

    /**
     * Disable timestamps in Offer MongoDB collection.
     *
     * @var bool
     */
    public $timestamps = false;

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

    /**
     * Retrieve all types of products in storage.
     *
     * @param $query
     *
     * @return mixed
     */
    public function getTypes() {
        return $this->raw(function($collection)
        {
            return $collection->distinct('type');
        });
    }

    /**
     * Retrieve all origins of products in storage.
     *
     * @param $query
     *
     * @return mixed
     */
    public function getOrigins() {
        return $this->raw(function($collection)
        {
            return $collection->distinct('origin');
        });
    }

    /**
     * Daily count of offers for given market for specified period of time.
     *
     * @param array|null $marketId
     * @param array|null $dateRange
     *
     * @return Collection
     */
    public function countByDateAndMarket(array $marketId = null, array $dateRange = null) {

        $marketIds = $this->normalizeMarketId($marketId);

        list($max, $min) = $this->normalizeDateRange($dateRange);

        $data = $this->raw(function($collection) use ($marketIds, $min, $max)
        {
            return $collection->aggregate([
                ['$match' => ['$and' => [['market_id' => ['$in' => $marketIds]], ['date' => [ '$gte' => $min, '$lte' => $max ]]]]],
                ['$lookup' => ['from' => 'markets','localField' => 'market_id','foreignField' => '_id', 'as' => 'market']],
                ['$unwind' => '$market'],
                ['$project' => [ "_id" => 0, "product" => 1, "date" => 1, "market_id" => 1, "market_name" => '$market.name', "market_slug" => '$market.slug']],
                ['$group' => ['_id' => [ 'date' => '$date', 'market_name' => '$market_name', 'market_id' => '$market_id', "market_slug" => '$market_slug'], 'count' => [ '$sum' => 1 ]]]
            ]);
        });

        return $this->serializeOutput($data);
    }


    /**
     * Serialize output to required format and structure.
     *
     * @param Collection $data
     *
     * @return Collection
     */
    protected function serializeOutput(Collection $data)
    {
        return $data->map(function ($item) {
            return [
                'date' => $this->asDateTime($item['_id']['date'])->format('Y-m-d'),
                'market_id' => $item['_id']['market_id'],
                'market_name' => $item['_id']['market_name'],
                'market_slug' => $item['_id']['market_slug'],
                'count' => $item['count']
            ];
        });
    }

    /**
     * @param array $marketId
     *
     * @return array
     */
    protected function normalizeMarketId(array $marketId = null)
    {
        if (!$marketId) {
            $marketIds = Market::all()->pluck('id')->map(function ($item) {
                return $this->asMongoID($item);
            })->toArray();
        } else {
            $marketIds = array_map(function ($item) {
                return $this->asMongoID($item);
            }, $marketId);
        }
        return $marketIds;
    }

    /**
     * @param array $dateRange
     *
     * @return array
     */
    protected function normalizeDateRange(array $dateRange = null)
    {
        if (!$dateRange) {
            $latestDate = $this->all()->max('date');
            $subtractMonth = $latestDate->copy()->subWeek();

            $max = $this->fromDateTime($latestDate);
            $min = $this->fromDateTime($subtractMonth);;
        } else {
            $min = $this->fromDateTime($dateRange[0]);
            $max = $this->fromDateTime($dateRange[1]);
        }
        return array($max, $min);
    }

}
