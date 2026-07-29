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

                    {{ $company->name }}

                </h3>

                <p class="text-muted">

                    Registered on {{ $company->created_at->format('d F Y') }}

                </p>

            </div>

            <div class="d-flex gap-2">

                @if (! $company->verified)
                    <form action="{{ route('admin.companies.toggle-verified', $company) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-patch-check me-2"></i>
                            Verify
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.companies.toggle-verified', $company) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger">
                            Unverify
                        </button>
                    </form>
                @endif

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
