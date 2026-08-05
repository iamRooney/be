@extends('admin.layouts.app')

@section('title', 'Requirement Details')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <a href="{{ route('admin.requirements.index') }}" class="text-decoration-none">

                    <i class="bi bi-arrow-left me-2"></i>

                    Back to Requirements

                </a>

                <h3 class="fw-bold mt-3">

                    {{ $requirement->requirement_number }}

                </h3>

                <p class="text-muted mb-0">

                    {{ $requirement->title }}

                </p>

            </div>

            @if ($requirement->status == 'open')
                <span class="badge bg-success fs-6">Open</span>
            @elseif($requirement->status == 'accepted')
                <span class="badge bg-info fs-6">Accepted</span>
            @else
                <span class="badge bg-secondary fs-6">Closed</span>
            @endif

        </div>

        <div class="row g-4">

            <div class="col-lg-8">

                @include('admin.requirements.partials.requirement-details')

            </div>

            <div class="col-lg-4">

                @include('admin.requirements.partials.sidebar')

                @include('admin.requirements.partials.moderation')

            </div>

        </div>

    </div>

@endsection
