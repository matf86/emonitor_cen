<?php

namespace App\Http\Controllers;

use App\Filters\LogsFilters;
use App\Http\Requests\IndexMarketLogs;
use App\Market;

class MarketLogsController extends Controller
{
    public function index(Market $market, IndexMarketLogs $request, LogsFilters $filters)
    {
        $logs = $market->logs()
            ->filter($filters)
            ->orderBy('created_at')
            ->get();

        return response()->json(['status' => (count($logs) === 0) ? 'no data': 'success', 'data' => $logs], 200);

    }
}
