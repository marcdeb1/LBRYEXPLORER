@extends('minimalUI.blank')


@push('script')
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script type="text/javascript" src="{{ asset('js/mining-inflation-chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/block-size-chart.js') }}"></script>
@endpush

@push('styles')
    <link href="{{ asset('/css/mining-inflation-chart.css') }}" rel="stylesheet">
@endpush

@section('icon', 'pe-7s-hammer')
@section('title', 'Mining statistics')
@section('header', 'Mining statistics')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="mining-inflation-chart-container">
                        <h3>Mining Inflation Chart</h3>
                        <div id="mining-inflation-chart" class="chart"></div>
                    </div>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="block-size-chart-container">
                        <h3>Block Size Chart</h3>
                        <div id="block-size-chart" class="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
