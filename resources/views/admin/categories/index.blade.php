@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')

    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-4">

            <div>
                <h2 class="fw-bold mb-1">Categories</h2>
                <p class="text-muted mb-0">
                    Manage all categories available in your marketplace.
                </p>
            </div>

            <div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary shadow-sm px-4">

                    <i class="bi bi-plus-circle me-2"></i>

                    Add Category

                </a>
            </div>

        </div>

        {{-- Success --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm">

                <i class="bi bi-check-circle-fill me-2"></i>

                {{ session('success') }}

                <button class="btn-close" data-bs-dismiss="alert">
                </button>

            </div>
        @endif

        {{-- Statistics --}}
        <div class="row g-4 mb-4">

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-uppercase text-muted">
                                    Total Categories
                                </small>

                                <h2 class="fw-bold mt-2">

                                    {{ $categories->total() }}

                                </h2>

                            </div>

                            <div class="rounded-circle bg-primary bg-opacity-10
                                    d-flex align-items-center justify-content-center"
                                style="width:60px;height:60px;">

                                <i class="bi bi-grid text-primary fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-uppercase text-muted">

                                    Active

                                </small>

                                <h2 class="fw-bold mt-2 text-success">

                                    {{ $categories->where('status', 1)->count() }}

                                </h2>

                            </div>

                            <div class="rounded-circle bg-success bg-opacity-10
                                    d-flex align-items-center justify-content-center"
                                style="width:60px;height:60px;">

                                <i class="bi bi-check-circle text-success fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-uppercase text-muted">

                                    Inactive

                                </small>

                                <h2 class="fw-bold mt-2 text-danger">

                                    {{ $categories->where('status', 0)->count() }}

                                </h2>

                            </div>

                            <div class="rounded-circle bg-danger bg-opacity-10
                                    d-flex align-items-center justify-content-center"
                                style="width:60px;height:60px;">

                                <i class="bi bi-x-circle text-danger fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Search --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <form method="GET" action="{{ route('admin.categories.index') }}">

                    <div class="row g-3">

                        <div class="col-lg-10">

                            <div class="input-group">

                                <span class="input-group-text bg-white">

                                    <i class="bi bi-search"></i>

                                </span>

                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control border-start-0" placeholder="Search categories...">

                            </div>

                        </div>

                        <div class="col-lg-2 d-grid">

                            <button class="btn btn-primary">

                                Search

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        {{-- Table --}}
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-0 py-3">

                <h5 class="fw-semibold mb-0">

                    Category List

                </h5>

            </div>

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="90">Icon</th>

                            <th>Name</th>

                            <th>Slug</th>

                            <th width="120">Status</th>

                            <th width="150">Created</th>

                            <th width="190" class="text-center">

                                Actions

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($categories as $category)
                            <tr>

                                <td>

                                    @if ($category->icon)
                                        <img src="{{ asset('uploads/categories/' . $category->icon) }}"
                                            class="rounded-3 border shadow-sm" width="60" height="60"
                                            style="object-fit:cover;">
                                    @else
                                        <div class="rounded-3 bg-light border
                                            d-flex align-items-center
                                            justify-content-center"
                                            style="width:60px;height:60px;">

                                            <i class="bi bi-image text-secondary fs-4"></i>

                                        </div>
                                    @endif

                                </td>

                                <td>

                                    <div class="fw-semibold">

                                        {{ $category->name }}

                                    </div>

                                    @if ($category->description)
                                        <small class="text-muted">

                                            {{ \Illuminate\Support\Str::limit($category->description, 55) }}

                                        </small>
                                    @endif

                                </td>

                                <td>

                                    <code>

                                        {{ $category->slug }}

                                    </code>

                                </td>

                                <td>

                                    <form action="{{ route('admin.categories.toggle-status', $category->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('PATCH')

                                        @if ($category->status)
                                            <button class="btn btn-sm btn-success rounded-pill px-3">

                                                {{-- <i class="bi bi-check-circle-fill me-1"></i> --}}

                                                Active

                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-secondary rounded-pill px-3">

                                                {{-- <i class="bi bi-pause-circle me-1"></i> --}}

                                                Inactive

                                            </button>
                                        @endif

                                    </form>

                                </td>

                                <td>

                                    <div class="fw-medium">

                                        {{ $category->created_at->format('d M Y') }}

                                    </div>

                                    <small class="text-muted">

                                        {{ $category->created_at->format('h:i A') }}

                                    </small>

                                </td>

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            class="btn btn-warning btn-sm">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this category?')">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="py-5 text-center">

                                    <div class="my-4">

                                        <div class="mb-3">

                                            <i class="bi bi-folder2-open display-2 text-secondary opacity-50"></i>

                                        </div>

                                        <h5 class="fw-bold">

                                            No Categories Found

                                        </h5>

                                        <p class="text-muted mb-4">

                                            Start by creating your first category.

                                        </p>

                                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">

                                            <i class="bi bi-plus-circle me-2"></i>

                                            Create Category

                                        </a>

                                    </div>

                                </td>

                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

            <div class="card-footer bg-white border-0">

                <div
                    class="d-flex flex-column flex-md-row
                        justify-content-between
                        align-items-center">

                    <div class="text-muted small mb-3 mb-md-0">

                        Showing

                        <strong>

                            {{ $categories->firstItem() ?? 0 }}

                        </strong>

                        to

                        <strong>

                            {{ $categories->lastItem() ?? 0 }}

                        </strong>

                        of

                        <strong>

                            {{ $categories->total() }}

                        </strong>

                        categories

                    </div>

                    <div>

                        {{ $categories->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

    <style>
        .card {
            border-radius: 16px;
        }

        .card-header {
            border-radius: 16px 16px 0 0 !important;
        }

        .table>tbody>tr:hover {
            background: #f8fafc;
            transition: .25s;
        }

        .table td,
        .table th {
            vertical-align: middle;
            padding: 18px;
        }

        .btn {
            border-radius: 10px;
        }

        .form-control,
        .form-select,
        .input-group-text {
            border-radius: 10px;
        }

        .input-group .form-control {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .input-group-text {
            border-right: none;
        }

        .shadow-sm {
            box-shadow:
                0 4px 20px rgba(0, 0, 0, .06) !important;
        }

        code {
            background: #f5f5f5;
            color: #0d6efd;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .table thead th {
            font-weight: 600;
            font-size: .9rem;
            color: #6c757d;
            border-bottom: none;
        }

        .alert {
            border: none;
            border-radius: 12px;
        }

        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            border-radius: 8px !important;
            margin: 0 2px;
            border: none;
            color: #495057;
        }

        .page-item.active .page-link {
            background: #0d6efd;
        }

        @media(max-width:768px) {

            .table td,
            .table th {
                padding: 12px;
            }

        }
    </style>

@endsection
