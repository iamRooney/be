@extends('admin.layouts.app')

@section('title', 'Enquiries')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h3 class="fw-bold mb-1">

                    Enquiries

                </h3>

                <p class="text-muted">

                    Manage buyer and seller enquiries.

                </p>

            </div>

            <button class="btn btn-primary">

                Export

            </button>

        </div>

        @include('admin.enquiries.partials.stats')

        @include('admin.enquiries.partials.filters')

        @include('admin.enquiries.partials.table')

    </div>

@endsection
