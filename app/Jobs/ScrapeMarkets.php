<?php

namespace App\Jobs;

use App\Market;
use App\Offer;
use Bschmitt\Amqp\Facades\Amqp;
use Carbon\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;

class ScrapeMarkets
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $date = Carbon::today();

        $marketsWithOffers = Offer::where('date', $date)->groupBy('market_id')->get()->pluck('market_id');

        $marketsToScrape = Market::whereNotIn('_id', $marketsWithOffers)->get()->pluck('slug');

        $msg = [
            'date' => $date->toDateTimeString(),
            'markets' => $marketsToScrape
        ];

        if (count($marketsToScrape) > 0) {
            Amqp::publish('', new \Bschmitt\Amqp\Message(json_encode($msg), ['content_type' => 'application/json', 'delivery_mode' => 1]));
        }
    }
}
