@extends('admin.layouts.app')

@section('title', 'User Details')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <a href="{{ route('admin.users.index') }}" class="text-decoration-none">

                    <i class="bi bi-arrow-left me-2"></i>

                    Back to Users

                </a>

                <h3 class="fw-bold mt-3 mb-1">

                    Rahul Nair

                </h3>

                <p class="text-muted">

                    Seller • Joined 12 June 2026

                </p>

            </div>

            <div class="d-flex gap-2">

                <button class="btn btn-warning">

                    Suspend

                </button>

                <button class="btn btn-success">

                    Activate

                </button>

            </div>

        </div>

        <div class="row g-4">

            <div class="col-lg-8">

                @include('admin.users.partials.profile')

                @include('admin.users.partials.personal-details')

                @include('admin.users.partials.statistics')

            </div>

            <div class="col-lg-4">

                @include('admin.users.partials.account-status')

                @include('admin.users.partials.login-history')

                @include('admin.users.partials.activity')

            </div>

        </div>

    </div>

@endsection
