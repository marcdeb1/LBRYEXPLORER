<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Block;
use Illuminate\Support\Facades\Cache;

class APIController extends Controller
{

  public function difficulty($last_n_hours) {
    $time = Carbon::now()->sub('hour', $last_n_hours)->timestamp;


    $diff = Block::where('block_time', '>', $time)
            ->orderBy('block_time', 'asc')
            ->select('height', 'block_time', 'difficulty')
            ->get();

    return response()->json($diff);
  }

  public function blockSize($last_n_hours) {
    $time = Carbon::now()->sub('hour', $last_n_hours)->timestamp;


    $diff = Block::where('block_time', '>', $time)
            ->orderBy('block_time', 'asc')
            ->select('height', 'block_time', 'block_size')
            ->get();

    return response()->json($diff);
  }

    public function miningStats() {
        if (Cache::has('miningStats')) {
            return response()->json([
                'success' => true,
                'data' => Cache::get('miningStats'),
            ]);
        } else {
            $blocks = Block::select('height', 'block_time')
                ->where('confirmations', '>', '0')
                ->whereRaw('(id-1) MOD 1000 = 0')
                ->orderBy('height', 'asc')
                ->get();
            Cache::put('miningStats', $blocks, $seconds = 600);
            return response()->json([
                'success' => true,
                'data' => $blocks,
            ]);
        }
    }
}
