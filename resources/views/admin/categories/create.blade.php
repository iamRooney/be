@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-4">
            <h3>Add Category</h3>

            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>

        <div class="card">

            <div class="card-body">

                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="mb-3">

                        <label>Category Name</label>

                        <input type="text" name="name" class="form-control" required>

                    </div>

                    <div class="mb-3">

                        <label>Description</label>

                        <textarea name="description" class="form-control" rows="4"></textarea>

                    </div>

                    <div class="mb-3">

                        <label>Category Icon</label>

                        <input type="file" name="icon" class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>Status</label>

                        <select name="status" class="form-select">

                            <option value="1">Active</option>

                            <option value="0">Inactive</option>

                        </select>

                    </div>

                    <button class="btn btn-primary">

                        Save Category

                    </button>

                </form>

            </div>

        </div>

    </div>
@endsection
