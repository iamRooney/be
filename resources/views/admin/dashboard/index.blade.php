@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold mb-1">
                    Platform Overview
                </h2>

                <p class="text-muted mb-0">
                    Welcome back, Administrator
                </p>

            </div>

            <div>

                <span class="badge bg-primary fs-6 px-3 py-2">

                    {{ now()->format('d M Y') }}

                </span>

            </div>

        </div>

        @include('admin.dashboard.partials.stats')

        <div class="row mt-4">

            <div class="col-lg-8">

                @include('admin.dashboard.partials.analytics')

            </div>

            <div class="col-lg-4">

                @include('admin.dashboard.partials.pending-approvals')

            </div>

        </div>

        <div class="row mt-4">

            <div class="col-lg-6">

                @include('admin.dashboard.partials.recent-companies')

            </div>

            <div class="col-lg-6">

                @include('admin.dashboard.partials.recent-enquiries')

            </div>

        </div>

        <div class="row mt-4 mb-4">

            <div class="col-lg-6">

                @include('admin.dashboard.partials.recent-listings')

            </div>

            <div class="col-lg-6">

                @include('admin.dashboard.partials.recent-activities')

            </div>

        </div>

    </div>

@endsection
