@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h3 class="fw-bold mb-1">
                    Product Listings
                </h3>

                <p class="text-muted mb-0">
                    Review and moderate all product listings.
                </p>

            </div>

            <button class="btn btn-primary rounded-pill px-4">

                <i class="bi bi-download me-2"></i>

                Export

            </button>

        </div>

        @include('admin.listings.partials.stats')

        @include('admin.listings.partials.filters')

        @include('admin.listings.partials.product-table')

    </div>

@endsection
