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

                    {{ $product->name }}

                </h3>

                <p class="text-muted mb-2">

                    Submitted by

                    <strong>

                        {{ $product->company->name ?? 'Unknown Company' }}

                    </strong>

                </p>

                <div class="d-flex gap-2">

                    <span class="badge bg-secondary">

                        {{ $product->category->name ?? 'No Category' }}

                    </span>

                    @if ($product->featured)
                        <span class="badge bg-primary">

                            Featured

                        </span>
                    @endif

                    @switch($product->status)
                        @case('approved')
                            <span class="badge bg-success">

                                Approved

                            </span>
                        @break

                        @case('pending')
                            <span class="badge bg-warning text-dark">

                                Pending

                            </span>
                        @break

                        @case('rejected')
                            <span class="badge bg-danger">

                                Rejected

                            </span>
                        @break
                    @endswitch

                </div>

            </div>

            <div class="d-flex gap-2">

                @if ($product->status != 'approved')
                    <form action="{{ route('admin.listings.products.approve', $product) }}" method="POST">

                        @csrf
                        @method('PATCH')

                        <button class="btn btn-success">

                            <i class="bi bi-check-circle me-2"></i>

                            Approve

                        </button>

                    </form>
                @endif

                @if ($product->status != 'rejected')
                    <form action="{{ route('admin.listings.products.reject', $product) }}" method="POST">

                        @csrf
                        @method('PATCH')

                        <button class="btn btn-danger">

                            Reject

                        </button>

                    </form>
                @endif

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
