<?php


namespace App\Utilities;

use Carbon\Carbon;
use App\Offer;

class DateConverter
{

    protected $offer;

    /**
     * DateConverter constructor.
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function setDate($placeId, $date = null)
    {
        return ($date)? new Carbon($date): $this->offer->getLatestDate($placeId);
    }

    public function setDateRange($placeIds, $minDate = null, $maxDate = null)
    {
        if(is_array($placeIds)) {
            $timeEndPoint = ($maxDate)? new Carbon($maxDate) : new Carbon();
        } else {
            $timeEndPoint = ($maxDate)? new Carbon($maxDate) : $this->offer->getLatestDate($placeIds);
        }

        $timeStartPoint = ($minDate)? new Carbon($minDate) : $timeEndPoint->copy()->subMonth();

        return [
            'maxDate' => $timeEndPoint,
            'minDate' => $timeStartPoint,
        ];
    }
}