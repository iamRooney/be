@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h3 class="fw-bold mb-1">

                    Users

                </h3>

                <p class="text-muted">

                    Manage buyers and sellers.

                </p>

            </div>

            <button class="btn btn-primary">

                Export Users

            </button>

        </div>

        @include('admin.users.partials.stats')

        @include('admin.users.partials.filters')

        @include('admin.users.partials.table')

    </div>

@endsection
