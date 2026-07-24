@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold mb-1">

                    Edit Category

                </h2>

                <p class="text-muted mb-0">

                    Update category information and settings.

                </p>

            </div>

            <a href="{{ route('admin.categories.index') }}" class="btn btn-light border shadow-sm">

                <i class="bi bi-arrow-left me-2"></i>

                Back

            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm">

                {{ session('success') }}

            </div>
        @endif

        @if ($errors->any())

            <div class="alert alert-danger shadow-sm">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-lg-8">

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white">

                            <h5 class="mb-0">

                                Category Information

                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Category Name

                                </label>

                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $category->name) }}">

                                @error('name')
                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>
                                @enderror

                            </div>

                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Description

                                </label>

                                <textarea name="description" rows="6" class="form-control">{{ old('description', $category->description) }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white">

                            <h5 class="mb-0">

                                Category Settings

                            </h5>

                        </div>

                        <div class="card-body">
                            {{-- Current Icon --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Current Icon

                                </label>

                                <div class="text-center border rounded-4 bg-light p-4">

                                    @if ($category->icon)
                                        <img id="preview" src="{{ asset('uploads/categories/' . $category->icon) }}"
                                            class="rounded-3 border shadow-sm" width="120" height="120"
                                            style="object-fit:cover;">
                                    @else
                                        <img id="preview" src="https://placehold.co/120x120?text=No+Icon"
                                            class="rounded-3 border" width="120" height="120">
                                    @endif

                                </div>

                            </div>

                            {{-- Replace Icon --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Replace Icon

                                </label>

                                <input type="file" name="icon" id="icon" class="form-control">

                                <small class="text-muted mt-2 d-block">

                                    Leave empty to keep the existing icon.

                                </small>

                            </div>

                            {{-- Status --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Status

                                </label>

                                <select name="status" class="form-select">

                                    <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>

                                        Active

                                    </option>

                                    <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>

                                        Inactive

                                    </option>

                                </select>

                            </div>

                            <hr>

                            <div class="d-grid">

                                <button class="btn btn-success btn-lg">

                                    <i class="bi bi-check-circle me-2"></i>

                                    Update Category

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

    <script>
        document
            .getElementById('icon')
            .addEventListener('change', function(e) {

                const file = e.target.files[0];

                if (file) {

                    document
                        .getElementById('preview')
                        .src = URL.createObjectURL(file);

                }

            });
    </script>
    <style>
        .card {
            border-radius: 16px;
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #eef2f7;
            border-radius: 16px 16px 0 0 !important;
        }

        .shadow-sm {
            box-shadow: 0 8px 24px rgba(15, 23, 42, .06) !important;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            min-height: 48px;
            border: 1px solid #dbe2ea;
        }

        textarea.form-control {
            min-height: 180px;
        }

        .form-control:focus,
        .form-select:focus {

            border-color: #0d6efd;

            box-shadow: 0 0 0 .15rem rgba(13, 110, 253, .15);

        }

        .form-label {

            font-weight: 600;

            color: #374151;

        }

        .btn {

            border-radius: 10px;

            font-weight: 600;

        }

        .btn-success {

            padding: 12px;

        }

        .alert {

            border: none;

            border-radius: 12px;

        }

        #preview {

            object-fit: cover;

            transition: .3s;

        }

        .border.rounded-4 {

            transition: .25s;

        }

        .border.rounded-4:hover {

            border-color: #0d6efd !important;

            background: #f8fbff !important;

        }

        .card-body {

            padding: 28px;

        }

        hr {

            margin: 1.5rem 0;

        }

        @media(max-width:992px) {

            .container-fluid {

                padding-left: 15px;
                padding-right: 15px;

            }

            .card-body {

                padding: 20px;

            }

        }
    </style>

@endsection
