<?php

namespace App\Http\Controllers;

use App\Claim;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function getClaims() {
        $claims = Claim::orderBy('id', 'desc')
            ->simplePaginate(25);

        return view('claims', [
            'claims' => $claims
        ]);
    }

    public function getClaim($claim = null) {
        if($claim) {
            $claim = Claim::where('claim_id', $claim)->firstOrFail();

            return view('claim', [
                'claim' => $claim
            ]);
        } else {
            return redirect('/claims');
        }
    }
}
