@extends('admin.layouts.app')

@section('title', 'Service Review')

@section('content')

    <div class="container-fluid">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <a href="{{ route('admin.listings.services.index') }}" class="text-decoration-none">
                    <i class="bi bi-arrow-left me-2"></i>Back to Services
                </a>

                <h3 class="fw-bold mt-3 mb-1">
                    {{ $service->name }}
                </h3>

                <p class="text-muted mb-0">
                    Submitted by {{ $service->company->name ?? '-' }}
                </p>
            </div>

            <div class="d-flex gap-2">

                @if ($service->status != 'approved')
                    <form action="{{ route('admin.listings.services.approve', $service) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success">
                            <i class="bi bi-check-circle me-2"></i>
                            Approve
                        </button>
                    </form>
                @endif

                @if ($service->status != 'rejected')
                    <form action="{{ route('admin.listings.services.reject', $service) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-danger">
                            <i class="bi bi-x-circle me-2"></i>
                            Reject
                        </button>
                    </form>
                @endif

                <button class="btn btn-warning text-white">
                    <i class="bi bi-pause-circle me-2"></i>
                    Suspend
                </button>

            </div>

        </div>

        <div class="row g-4">

            <!-- LEFT SIDE -->
            <div class="col-lg-8">

                <!-- Service Banner -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <img src="{{ $service->image ? asset('storage/' . $service->image) : 'https://placehold.co/1200x420' }}"
                        class="img-fluid rounded-top" alt="Service Banner">

                    <div class="card-body">

                        <h4 class="fw-bold mb-2">
                            {{ $service->name }}
                        </h4>

                        <p class="text-muted mb-0">
                            {{ $service->short_description }}
                        </p>

                    </div>

                </div>

                @include('admin.listings.partials.service-details', [
                    'service' => $service,
                ])

                @include('admin.listings.partials.service-description', [
                    'service' => $service,
                ])

                @include('admin.listings.partials.service-specifications', [
                    'service' => $service,
                ])

            </div>

            <!-- RIGHT SIDE -->
            <div class="col-lg-4">

                @include('admin.listings.partials.seller-card', [
                    'product' => $service,
                ])

                @include('admin.listings.partials.documents', [
                    'product' => $service,
                ])

                @include('admin.listings.partials.moderation', [
                    'product' => $service,
                ])

            </div>

        </div>

    </div>

@endsection
