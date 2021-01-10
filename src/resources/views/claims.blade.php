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

@section('icon', 'pe-7s-airplay')
@section('title', 'Claims')
@section('header', 'Claims')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body table-wrapper-scroll-y my-custom-scrollbar">
                    <div class="table-header d-flex justify-content-between mb-2">
                        <div class="card-title">Claims</div>
                        <div class="pagination">
                            {{ $claims->links() }}
                        </div>
                    </div>
                    <div class="mb-0 table table-hover table-striped">
                        <div class="d-flex flex-wrap col-lg-12 p-0">
                            @foreach ($claims as $claim)
                                <div class="col-xs-12 col-md-4 mb-3 px-2 py-0">
                                    @include('components.claim_box', array(['claim' => $claim]))
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
