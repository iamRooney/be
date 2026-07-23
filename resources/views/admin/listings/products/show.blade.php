@extends('admin.layouts.app')

@section('title', 'Product Review')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <a href="{{ route('admin.listings.products.index') }}" class="text-decoration-none">

                    <i class="bi bi-arrow-left me-2"></i>

                    Back to Products

                </a>

                <h3 class="fw-bold mt-3 mb-1">

                    Arduino UNO R4

                </h3>

                <p class="text-muted">

                    Submitted by ABC Electronics

                </p>

            </div>

            <div class="d-flex gap-2">

                <button class="btn btn-success">

                    <i class="bi bi-check-circle me-2"></i>

                    Approve

                </button>

                <button class="btn btn-danger">

                    Reject

                </button>

            </div>

        </div>

        <div class="row g-4">

            <div class="col-lg-8">

                @include('admin.listings.partials.gallery')

                @include('admin.listings.partials.product-details')

                @include('admin.listings.partials.specifications')

                @include('admin.listings.partials.description')

            </div>

            <div class="col-lg-4">

                @include('admin.listings.partials.seller-card')

                @include('admin.listings.partials.documents')

                @include('admin.listings.partials.moderation')

            </div>

        </div>

    </div>

@endsection
