<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body">

        <form method="GET" action="{{ route('admin.listings.products.index') }}">

            <div class="row g-3">

                <div class="col-lg-3">

                    <label class="form-label fw-semibold">
                        Search
                    </label>

                    <input type="text" name="search" class="form-control" placeholder="Search products..."
                        value="{{ request('search') }}">

                </div>

                <div class="col-lg-2">

                    <label class="form-label fw-semibold">
                        Company
                    </label>

                    <select name="company" class="form-select">

                        <option value="">
                            All Companies
                        </option>

                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ request('company') == $company->id ? 'selected' : '' }}>

                                {{ $company->name }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div class="col-lg-2">

                    <label class="form-label fw-semibold">
                        Category
                    </label>

                    <select name="category" class="form-select">

                        <option value="">
                            All Categories
                        </option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div class="col-lg-2">

                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <select name="status" class="form-select">

                        <option value="">All</option>

                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                            Approved
                        </option>

                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>

                    </select>

                </div>

                <div class="col-lg-1">

                    <label class="form-label fw-semibold">
                        Featured
                    </label>

                    <select name="featured" class="form-select">

                        <option value="">All</option>

                        <option value="1" {{ request('featured') === '1' ? 'selected' : '' }}>
                            Yes
                        </option>

                        <option value="0" {{ request('featured') === '0' ? 'selected' : '' }}>
                            No
                        </option>

                    </select>

                </div>

                <div class="col-lg-2 d-flex gap-2 align-items-end">

                    <button type="submit" class="btn btn-primary flex-fill">

                        <i class="bi bi-search me-1"></i>

                        Apply

                    </button>

                    <a href="{{ route('admin.listings.products.index') }}" class="btn btn-outline-secondary">

                        <i class="bi bi-arrow-clockwise"></i>

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>
