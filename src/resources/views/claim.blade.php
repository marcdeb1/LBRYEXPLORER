@extends('minimalUI.blank')

@section('icon', 'pe-7s-airplay')
@section('title', 'Claim '.$claim->id)
@section('header', 'Claim '.$claim->id)
@section('description', $claim->hash)

@section('content')
<div class="row">
  <div class="col-lg-5 mb-4 mb-lg-0">
    <div class="main-card mb-3 card">
      <div class="card-header">Overview</div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 mb-2">
              <div class="text-primary">Block Size</div>
                {{ $block->block_size }} kB
            </div>
            <div class="col-lg-6 mb-2">
              <div class="text-primary">Block Time</div>
                {{ $block->block_time }} UTC
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 mb-2">
              <div class="text-primary">Bits</div>
                {{ $block->bits }}
            </div>
            <div class="col-lg-6 mb-2">
              <div class="text-primary">Confirmations</div>
                {{ $block->confirmations }}
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 mb-2">
              <div class="text-primary">Difficulty</div>
                {{ number_format($block->difficulty) }}
            </div>
            <div class="col-lg-6 mb-2">
              <div class="text-primary">Nonce</div>
                {{ $block->nonce }}
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 mb-2">
              <div class="text-primary">Transactions</div>
                {{ count($transactions) }}
            </div>
            <div class="col-lg-6 mb-2">
              <div class="text-primary">Version</div>
                {{ $block->version }}
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">Hash</div>
                {{ $block->hash }}
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">Chainwork</div>
                {{ $block->chainwork }}
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">Merkle Root</div>
                {{ $block->merkle_root }}
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">Name Claim Root</div>
                {{ $block->name_claim_root }}
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="col-lg-7 mb-4 mb-lg-0">
    <div class="main-card mb-3 card">
        <div class="card-body table-wrapper-scroll-y my-custom-scrollbar">
          <h5 class="card-title">Block Transactions</h5>
            <table class="mb-0 table table-hover">
                <thead>
                <tr>
                    <th>Hash</th>
                    <th>Inputs</th>
                    <th>Outputs</th>
                    <th>Value</th>
                    <th>Size</th>
                    <th>Fee</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    </div>
  </div>



@endsection
