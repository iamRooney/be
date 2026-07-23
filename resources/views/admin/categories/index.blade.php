@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Categories</h3>

            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                + Add Category
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mb-3">
            <div class="card-body">

                <form method="GET" action="{{ route('admin.categories.index') }}">

                    <div class="row">

                        <div class="col-md-10">

                            <input type="text" name="search" class="form-control" placeholder="Search category..."
                                value="{{ request('search') }}">

                        </div>

                        <div class="col-md-2 d-grid">

                            <button class="btn btn-primary">

                                Search

                            </button>

                        </div>

                    </div>

                </form>

            </div>
        </div>

        <div class="card shadow-sm">

            <div class="card-body">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th width="80">Icon</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th width="120">Status</th>
                            <th width="170">Created</th>
                            <th width="180">Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($categories as $category)
                            <tr>

                                <td>

                                    @if ($category->icon)
                                        <img src="{{ asset('uploads/categories/' . $category->icon) }}" width="50"
                                            height="50" class="rounded border">
                                    @else
                                        -
                                    @endif

                                </td>

                                <td>{{ $category->name }}</td>

                                <td>{{ $category->slug }}</td>

                                <td>

                                    <form action="{{ route('admin.categories.toggle-status', $category->id) }}"
                                        method="POST" class="d-inline">

                                        @csrf
                                        @method('PATCH')

                                        @if ($category->status)
                                            <button type="submit" class="btn btn-success btn-sm">

                                                Active

                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-secondary btn-sm">

                                                Inactive

                                            </button>
                                        @endif

                                    </form>

                                </td>

                                <td>

                                    {{ $category->created_at->format('d M Y') }}

                                </td>

                                <td>

                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="btn btn-warning btn-sm">

                                        Edit

                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this category?')">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">

                                    No Categories Found

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

                <div class="mt-3">

                    {{ $categories->links() }}

                </div>

            </div>

        </div>

    </div>

@endsection
