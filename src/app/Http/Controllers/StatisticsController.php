<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Address;
use App\TransactionAddress;


class StatisticsController extends Controller
{
    public function getMiningStats() {
        return view('statistics_mining', [
        ]);
    }

    public function getMiningStatsData() {
        $blocks = Block::select('height', 'block_time')
            ->where('confirmations', '>', '0')
            ->orderBy('height')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $blocks,
        ]);
    }
}
