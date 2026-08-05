@extends('admin.layouts.app')

@section('title', 'RFQ / Requirements')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h3 class="fw-bold mb-1">

                    Post Your Requirement (RFQ)

                </h3>

                <p class="text-muted">

                    Requirements buyers have posted, and which supplier accepted each one first.

                </p>

            </div>

        </div>

        @include('admin.requirements.partials.stats')

        @include('admin.requirements.partials.filters')

        @include('admin.requirements.partials.table')

    </div>

@endsection
