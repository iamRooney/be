@extends('admin.layouts.app')

@section('title', 'Companies')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h3 class="fw-bold mb-1">
                    Companies
                </h3>

                <p class="text-muted mb-0">
                    Manage registered businesses on Exbhex.
                </p>

            </div>

            <button class="btn btn-primary rounded-pill px-4">

                <i class="bi bi-download me-2"></i>

                Export

            </button>

        </div>

        @include('admin.companies.partials.stats')

        @include('admin.companies.partials.filters')

        @include('admin.companies.partials.table')

    </div>

@endsection
