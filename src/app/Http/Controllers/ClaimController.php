<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function getClaims() {
        $claims = Block::select('height', 'block_time', 'transaction_hashes', 'block_size', 'difficulty', 'nonce')->orderBy('id', 'desc')->simplePaginate(25);

        return view('claims', [
            'claims' => $claims
        ]);
    }

    public function getClaim($claim = null) {
        if($claim) {


        } else {
            return redirect('/claims');
        }
    }
}
