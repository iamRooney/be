@extends('admin.layouts.app')

@section('title', 'Company Details')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <a href="{{ route('admin.companies.index') }}" class="text-decoration-none">

                    <i class="bi bi-arrow-left me-2"></i>

                    Back to Companies

                </a>

                <h3 class="fw-bold mt-3">

                    ABC Electronics

                </h3>

                <p class="text-muted">

                    Registered on 12 June 2026

                </p>

            </div>

            <div class="d-flex gap-2">

                <button class="btn btn-success">

                    <i class="bi bi-patch-check me-2"></i>

                    Verify

                </button>

                <button class="btn btn-danger">

                    Reject

                </button>

            </div>

        </div>

        <div class="row g-4">

            <div class="col-lg-8">

                @include('admin.companies.partials.company-overview')

                @include('admin.companies.partials.business-details')

                @include('admin.companies.partials.products-services')

            </div>

            <div class="col-lg-4">

                @include('admin.companies.partials.verification-card')

                @include('admin.companies.partials.documents')

                @include('admin.companies.partials.activity')

            </div>

        </div>

    </div>

@endsection
