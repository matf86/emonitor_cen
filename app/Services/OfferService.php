<?php

namespace App\Services;

use App\Offer;
use App\Utilities\DateConverter;
use Carbon\Carbon;


class OfferService
{

    protected $converter;
    protected $offer;

    /**
     * OfferService constructor.
     */
    public function __construct(DateConverter $converter, Offer $offer)
    {
        $this->converter = $converter;
        $this->offer = $offer;
    }

    public function getOffersByDate($slug, $placeId, $date = null)
    {
        if($this->invalidArguments($slug, $placeId)) {
            throw new \InvalidArgumentException();
        }

        $date = $this->converter->setDate($placeId, $date);

        $offers =  $this->offer->getByDate($slug, $placeId, $date);

        return $offers;
    }

    public function getOffersForProductInTimeRange($name, $placeId, $minDate = null, $maxDate = null)
    {
        if($this->invalidArguments($name, $placeId)) {
            throw new \InvalidArgumentException();
        }

        $dateRange = $this->converter->setDateRange($placeId, $minDate, $maxDate);

        $offers = $this->offer->getProductInTimeRange($name, $placeId, $dateRange['minDate'], $dateRange['maxDate']);

        return $offers;
    }

    public function getDistinctEntriesInTimeRange($placeIds, $minDate = null, $maxDate = null)
    {
        $dateRange = $this->converter->setDateRange($placeIds, $minDate, $maxDate);

        $result = $this->offer->distinctEntriesInTimeRange($placeIds, $dateRange['minDate'], $dateRange['maxDate']);

        $result = $result->map(function($item) {
            return [
               'date' => Carbon::createFromTimestamp($item['_id']['date']->toDateTime()->getTimestamp())->toDateString(),
               'place' => $item['_id']['place_name'],
               'place_id' => $item['_id']['place_id'],
               'count' => $item['count']
           ];
        });

        return $result;
    }

    protected function invalidArguments($string, $id) {
        return (!is_string($string) || trim($string) == '') || (!$id instanceof \MongoDB\BSON\ObjectID);
    }

}