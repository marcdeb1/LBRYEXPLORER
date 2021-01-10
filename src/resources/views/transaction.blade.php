use Illuminate\Support\Str;

@extends('minimalUI.blank')

@section('icon', 'pe-7s-diamond')
@section('title', 'Transaction Hash Details')
@section('header', 'Transaction '.$transaction->small_hash)

@section('content')

<div class="row">
  <div class="col-lg-5 mb-4 mb-lg-0">
    <div class="main-card mb-3 card">
      <div class="card-header">Overview</div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">
                Hash
              </div>
                <span>{{ $transaction->hash }}</span>@include('components.copy_to_clipboard_button', array('text' => $transaction->hash, 'id' => "transactionHashClipboard"))
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-2">
              <div class="text-primary">
                Block Height
              </div>
                @if ($transaction->block_hash_id == 'MEMPOOL')
                    <i>(Pending)</i>
                @else
                    <div class="d-flex">
                        <a class="" href="{{ route('block', $transaction->block_height) }}">{{ $transaction->block_height }}</a>
                        <span class="confirmation-label ml-2" data-toggle="tooltip" title="" data-original-title="Number of blocks mined since">
                            {{ $transaction->confirmations }} {{ Str::plural('Confirmation', $transaction->confirmations) }}
                        </span>
                    </div>
                @endif
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-2">
                @if ($transaction->block_hash_id != 'MEMPOOL')
                    <div class="text-primary">
                        Timestamp
                        <span class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Date and time at which the transaction was mined"></span>
                    </div>
                    <div>
                        {{ $transaction->transaction_time }}
                        <span class="text-secondary ml-2 d-none d-sm-inline-block">
                            | Confirmed within {{ $transaction->confirmation_difference }}
                        </span>
                    </div>
                @else
                    <div class="text-primary">
                      Time First Seen
                      <span class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Time when the transaction was first seen in the network pool"></span>
                    </div>
                    <div>
                        <i class="fas fa-spinner fa-spin"></i>
                        {{ $transaction->first_seen_time_ago }}
                        ({{ $transaction->created_at }})
                    </div>
                @endif
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 mb-2">
              <div class="text-primary">
                Amount
              </div>
                {{ $transaction->value }} LBC
            </div>
              <div class="col-lg-6 mb-2">
                  <div class="text-primary">
                      Fee
                  </div>
                  @if ($transaction->block_hash_id != 'MEMPOOL')
                    {{ $transaction->fee }} LBC
                  @else
                    <i>(Pending)</i>
                  @endif
              </div>
          </div>
            <div class="row">
                <div class="col-lg-6 mb-2">
                    <div class="text-primary">
                        Inputs
                    </div>
                    {{ $transaction->input_count }}
                </div>
                <div class="col-lg-6 mb-2">
                    <div class="text-primary">
                        Outputs
                    </div>
                    {{ $transaction->output_count }}
                </div>
            </div>
            <div class="collapse" id="collapsePanel">
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div class="text-primary">
                            Size
                        </div>
                        {{ $transaction->transaction_size }} kB
                    </div>
                </div>
                <!--
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div class="text-primary">
                            Script signature
                            <span class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Transaction inputs script signatures in hexadecimal format"></span>
                        </div>
                        @foreach($inputs as $input)
                            <div><span>{{ substr($input->script_sig_hex, 0, 30) }}...</span>@include('components.copy_to_clipboard_button', array('text' => $input->script_sig, 'id' => "transactionOutputPubKey".$loop->index))</div>
                        @endforeach
                    </div>
                </div>
                -->
            </div>
            <span>
                <a class="d-block collapsed text-decoration-none" id="collapseLink" data-toggle="collapse" href="#collapsePanel" role="button" aria-expanded="false" aria-controls="collapse">
                    <span class="d-flex">
                        Click to see&nbsp;
                        <span class="card-arrow-more">more</span>
                        <span class="card-arrow-less">less</span>
                        <span class="card-btn-arrow ml-2 d-flex align-items-center">
                            <span class="fas fa-arrow-up small"></span>
                        </span>
                    </span>
                </a>
            </span>
        </div>
    </div>
  </div>
  <div class="col-lg-7 mb-4 mb-lg-0">
    <div class="main-card mb-3 card">
      <div class="card-header">Details</div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5 mb-4 mb-sm-0">
            <h5 class="card-title">{{ $transaction->input_count }} inputs</h5>

            @foreach ($inputs as $input)
              <div class="card-shadow-primary border mb-3 card card-body border-primary">
                @if ($input->is_coinbase)
                  <h5 class="card-title">Block Reward</h5>
                  New Coins
                @else
                  <h5 class="card-title">{{ $input->value }} LBC</h5>
                  <p>
                    from <a href="{{ route('address', $input->address) }}">{{ $input->address }}</a> <a href="{{ route('transaction', $input->prevout_hash) }}">(output)</a>
                  </p>
                @endif
              </div>
            @endforeach

          </div>

          <div class="mt-3">
            <i class="fa fa-8x fa-angle-right icon-gradient bg-malibu-beach"> </i>
          </div>

          <div class="col-sm-5 mb-4 mb-sm-0">
            <h5 class="card-title">{{ $transaction->output_count }} outputs</h5>

            @foreach ($outputs as $output)
              <div class="card-shadow-info border mb-3 card card-body border-info">
                <h5 class="card-title">
                  {{ $output->value }} LBC
                  <div
                  @switch ($output->opcode_friendly[0])
                    @case('N')
                      class="mb-2 mr-2 badge badge-success py-1 px-1">
                      @break
                    @case('U')
                      class="mb-2 mr-2 badge badge-info py-1 px-1">
                      @break
                    @case('S')
                      class="mb-2 mr-2 badge badge-alternate py-1 px-1">
                      @break
                    @default
                      @break
                  @endswitch
                  {{ $output->opcode_friendly }}</div>
                </h5>
                <p>
                  to
                  @foreach ($output->address_list as $recipient_address)
                    <a href="{{ route('address', $recipient_address) }}">{{ $recipient_address }}</a>
                    @if ($output->is_spent)
                      <a href="{{ route('transaction', $output->spent_hash) }}">(spent)</a>
                    @else
                      (unspent)
                    @endif
                  @endforeach
                </p>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
