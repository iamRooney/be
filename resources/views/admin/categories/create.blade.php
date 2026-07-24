@extends('admin.layouts.app')

@section('title', 'Add Category')

@section('content')

    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold mb-1">

                    Add Category

                </h2>

                <p class="text-muted mb-0">

                    Create a new category for your marketplace.

                </p>

            </div>

            <a href="{{ route('admin.categories.index') }}" class="btn btn-light border shadow-sm">

                <i class="bi bi-arrow-left me-2"></i>

                Back

            </a>

        </div>


        {{-- Validation --}}
        @if ($errors->any())

            <div class="alert alert-danger shadow-sm">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row">

                <div class="col-lg-8">

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white">

                            <h5 class="mb-0">

                                Category Information

                            </h5>

                        </div>

                        <div class="card-body">

                            {{-- Name --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Category Name

                                </label>

                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter category name">

                                @error('name')
                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>
                                @enderror

                            </div>

                            {{-- Description --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Description

                                </label>

                                <textarea name="description" rows="6" class="form-control" placeholder="Write category description...">{{ old('description') }}</textarea>

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

                            {{-- Icon Upload --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Category Icon

                                </label>

                                <div class="border rounded-4 p-4 text-center bg-light">

                                    <img id="preview" src="https://placehold.co/120x120?text=Icon"
                                        class="rounded-3 border mb-3" width="120" height="120"
                                        style="object-fit:cover;">

                                    <input type="file" name="icon" id="icon" class="form-control">

                                    <small class="text-muted d-block mt-2">

                                        PNG, JPG, JPEG supported

                                    </small>

                                </div>

                            </div>

                            {{-- Status --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Status

                                </label>

                                <select name="status" class="form-select">

                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>

                                        Active

                                    </option>

                                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>

                                        Inactive

                                    </option>

                                </select>

                            </div>

                            <hr>

                            <div class="d-grid">

                                <button class="btn btn-primary btn-lg">

                                    <i class="bi bi-check-circle me-2"></i>

                                    Save Category

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
            border-bottom: 1px solid #f1f3f5;
            border-radius: 16px 16px 0 0 !important;
        }

        .shadow-sm {
            box-shadow: 0 6px 20px rgba(0, 0, 0, .06) !important;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            min-height: 30px;
        }

        textarea.form-control {
            min-height: 160px;
        }

        .form-control:focus,
        .form-select:focus {

            border-color: #0d6efd;

            box-shadow: 0 0 0 .15rem rgba(13, 110, 253, .15);

        }

        .btn {
            border-radius: 10px;
        }

        #preview {

            object-fit: cover;

            transition: .25s;

        }

        .border.rounded-4 {

            transition: .25s;

        }

        .border.rounded-4:hover {

            border-color: #0d6efd !important;

            background: #f8fbff !important;

        }

        .form-label {

            color: #495057;

            margin-bottom: .55rem;

        }

        .alert {

            border: none;

            border-radius: 12px;

        }

        @media(max-width:992px) {

            .container-fluid {

                padding-left: 15px;
                padding-right: 15px;

            }

        }
    </style>

@endsection
