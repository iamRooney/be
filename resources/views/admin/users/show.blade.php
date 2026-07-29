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

                    {{ $user->name }}

                </h3>

                <p class="text-muted">

                    {{ ucfirst($user->role ?? 'buyer') }} • Joined {{ $user->created_at->format('j F Y') }}

                </p>

            </div>

            <div class="d-flex gap-2">

                <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">

                    @csrf
                    @method('PATCH')

                    @if ($user->status)
                        <button type="submit" class="btn btn-warning">
                            Suspend
                        </button>
                    @else
                        <button type="submit" class="btn btn-success">
                            Activate
                        </button>
                    @endif

                </form>

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
