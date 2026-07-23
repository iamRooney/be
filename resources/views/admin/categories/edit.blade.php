@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Edit Category</h3>

            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                ← Back
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">

                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>

                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>

                        <textarea name="description" rows="4" class="form-control">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <!-- Current Icon -->
                    <div class="mb-3">

                        <label class="form-label">Current Icon</label>

                        <br>

                        @if ($category->icon)
                            <img src="{{ asset('uploads/categories/' . $category->icon) }}" width="120"
                                class="img-thumbnail">
                        @else
                            <p>No icon uploaded.</p>
                        @endif

                    </div>

                    <!-- New Icon -->
                    <div class="mb-3">

                        <label class="form-label">Replace Icon</label>

                        <input type="file" name="icon" class="form-control">

                    </div>

                    <!-- Status -->
                    <div class="mb-4">

                        <label class="form-label">Status</label>

                        <select name="status" class="form-select">

                            <option value="1" {{ $category->status ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ !$category->status ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                    <button class="btn btn-success">
                        Update Category
                    </button>

                </form>

            </div>
        </div>

    </div>

@endsection
