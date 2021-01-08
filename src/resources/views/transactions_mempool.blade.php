@extends('minimalUI.blank')

@push('styles')
<style>
  .pagination.center,
  .pagination.center ul {
    float: left;
    position: relative;
  }
  .pagination.center {
    left: 50%;
  }
  .pagination.center ul {
    left: -50%;
  }
  .my-custom-scrollbar {
    position: relative;
    overflow: auto;
  }
  .table-wrapper-scroll-y {
    display: block;
  }
</style>
@endpush

@section('icon', 'pe-7s-diamond')
@section('title', 'Mempool Transactions')
@section('header', 'Mempool Transactions')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="main-card mb-3 card">
      <div class="card-body table-wrapper-scroll-y my-custom-scrollbar">
          <div class="table-header d-flex justify-content-between mb-2">
              <div class="card-title">Mempool transactions</div>
              <div class="pagination">
                  {{ $transactions->links() }}
              </div>
          </div>
        <table class="mb-0 table table-hover table-striped">
          <thead>
            <tr>
              <th>Hash</th>
              <th>Value</th>
              <th>Inputs</th>
              <th>Outputs</th>
              <th>Size</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($transactions as $transaction)
              <tr>
                <th scope="row"><a href="{{ route('transactions', $transaction->hash) }}">{{ substr($transaction->hash, 0, 10) }}..</a></th>
                <td>{{ $transaction->value }} LBC</td>
                <td>{{ $transaction->input_count }}</td>
                <td>{{ $transaction->output_count }}</td>
                <td>{{ $transaction->transaction_size }} kB</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
