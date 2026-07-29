@extends('admin.layouts.app')

@section('title', 'Services')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h3 class="fw-bold mb-1">
                    Service Listings
                </h3>

                <p class="text-muted mb-0">
                    Review and moderate all service listings.
                </p>

            </div>

            <button class="btn btn-primary rounded-pill">

                <i class="bi bi-download me-2"></i>

                Export

            </button>

        </div>

        @include('admin.listings.partials.stats', ['label' => 'Services'])

        @include('admin.listings.partials.filters')

        @include('admin.listings.partials.service-table')

    </div>

@endsection
