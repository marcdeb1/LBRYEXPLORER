<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Address;
use App\TransactionAddress;


class AddressController extends Controller
{


  public function getAddress($address) {

    $address = Address::where('address', $address)->firstOrFail();
    $txs = TransactionAddress::where('address_id', $address->id)
            ->leftJoin('transaction', 'transaction_address.transaction_id', 'transaction.id')
            ->leftJoin('block', 'transaction.block_hash_id', 'block.hash')
            ->select('transaction_address.credit_amount', 'transaction_address.debit_amount', 'transaction.transaction_time', 'transaction.transaction_size', 'transaction.hash', 'transaction.input_count', 'transaction.output_count', 'block.height')
            ->orderBy('height', 'desc')
            ->simplePaginate(25);

    $transaction_amounts = TransactionAddress::where('address_id', $address->id)
          ->leftJoin('transaction', 'transaction_address.transaction_id', 'transaction.id')
          ->select('transaction_address.credit_amount', 'transaction_address.debit_amount')
          ->get();

    $address->total_received = 0;
    $address->total_sent = 0;
    foreach($transaction_amounts as $amount) {
        $transaction_amount = $amount->credit_amount - $amount->debit_amount;
        if($transaction_amount > 0) {
            $address->total_received += $transaction_amount;
        } else {
            $address->total_sent += abs($transaction_amount);
        }
    }

    $txs->transform(function ($item, $key) use (& $address) {
        $item->transaction_time = Carbon::createFromTimestamp($item->transaction_time)->format('d M Y  H:i:s');
        $item->transaction_size /= 1000;
        $item->transaction_amount = $item->credit_amount - $item->debit_amount;

        return $item;
    });

    return view('address', [
      'address' => $address,
      'transactions' => $txs
    ]);
  }




}
