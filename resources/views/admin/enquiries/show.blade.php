@extends('admin.layouts.app')

@section('title', 'Enquiry Details')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <a href="{{ route('admin.enquiries.index') }}" class="text-decoration-none">

                    <i class="bi bi-arrow-left me-2"></i>

                    Back to Enquiries

                </a>

                <h3 class="fw-bold mt-3">

                    Enquiry {{ $enquiry->enquiry_number }}

                </h3>

                <p class="text-muted mb-0">

                    {{ $enquiry->product_id ? 'Product Enquiry' : 'Service Enquiry' }}

                </p>

            </div>

            @if ($enquiry->status == 'open')
                <form action="{{ route('admin.enquiries.update', $enquiry) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="closed">
                    <button type="submit" class="btn btn-success">
                        Mark Closed
                    </button>
                </form>
            @else
                <span class="badge bg-secondary fs-6">Closed</span>
            @endif

        </div>

        <div class="row g-4">

            <div class="col-lg-8">

                @include('admin.enquiries.partials.conversation')

            </div>

            <div class="col-lg-4">

                @include('admin.enquiries.partials.product-card')

                @include('admin.enquiries.partials.enquiry-sidebar')

                @include('admin.enquiries.partials.moderation')

            </div>

        </div>

    </div>

@endsection
