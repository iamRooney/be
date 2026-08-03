@extends('admin.layouts.app')

@section('title', 'Edit Company')

@section('content')

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold mb-1">

                    Edit Company

                </h2>

                <p class="text-muted mb-0">

                    Update {{ $company->name }}'s business details.

                </p>

            </div>

            <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-light border shadow-sm">

                <i class="bi bi-arrow-left me-2"></i>

                Back

            </a>

        </div>

        @if ($errors->any())

            <div class="alert alert-danger shadow-sm">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('admin.companies.update', $company) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-lg-8">

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <h5 class="mb-0">

                                Company Information

                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6 mb-4">

                                    <label class="form-label fw-semibold">Company Name</label>

                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $company->name) }}">

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label fw-semibold">GST Number</label>

                                    <input type="text" name="gst_number"
                                        class="form-control @error('gst_number') is-invalid @enderror"
                                        value="{{ old('gst_number', $company->gst_number) }}">

                                    @error('gst_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label fw-semibold">Email</label>

                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $company->email) }}">

                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label fw-semibold">Phone</label>

                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $company->phone) }}">

                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label fw-semibold">Website</label>

                                    <input type="text" name="website" placeholder="https://example.com"
                                        class="form-control @error('website') is-invalid @enderror"
                                        value="{{ old('website', $company->website) }}">

                                    @error('website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-6 mb-4">

                                    <label class="form-label fw-semibold">Address</label>

                                    <input type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address', $company->address) }}">

                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>

                            <div class="mb-2">

                                <label class="form-label fw-semibold">Description</label>

                                <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description', $company->description) }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>

                        </div>

                    </div>

                    <div class="card border-0 shadow-sm mb-4">

                        <div class="card-header bg-white">

                            <h5 class="mb-0">

                                Location

                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-4 mb-4">

                                    <label class="form-label fw-semibold">Country</label>

                                    <select name="country_id" id="country_id"
                                        class="form-select @error('country_id') is-invalid @enderror">

                                        <option value="">Select Country</option>

                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ old('country_id', $company->country_id) == $country->id ? 'selected' : '' }}>

                                                {{ $country->name }}

                                            </option>
                                        @endforeach

                                    </select>

                                    @error('country_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-4 mb-4">

                                    <label class="form-label fw-semibold">State</label>

                                    <select name="state_id" id="state_id"
                                        class="form-select @error('state_id') is-invalid @enderror">

                                        <option value="">Select State</option>

                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}" data-country="{{ $state->country_id }}"
                                                {{ old('state_id', $company->state_id) == $state->id ? 'selected' : '' }}>

                                                {{ $state->name }}

                                            </option>
                                        @endforeach

                                    </select>

                                    @error('state_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="col-md-4 mb-4">

                                    <label class="form-label fw-semibold">City</label>

                                    <select name="city_id" id="city_id"
                                        class="form-select @error('city_id') is-invalid @enderror">

                                        <option value="">Select City</option>

                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" data-state="{{ $city->state_id }}"
                                                {{ old('city_id', $company->city_id) == $city->id ? 'selected' : '' }}>

                                                {{ $city->name }}

                                            </option>
                                        @endforeach

                                    </select>

                                    @error('city_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="card border-0 shadow-sm">

                        <div class="card-header bg-white">

                            <h5 class="mb-0">

                                Business Details

                            </h5>

                        </div>

                        <div class="card-body">

                            <div class="mb-4">

                                <label class="form-label fw-semibold">Years in Business</label>

                                <input type="number" name="years_in_business" min="0"
                                    class="form-control @error('years_in_business') is-invalid @enderror"
                                    value="{{ old('years_in_business', $company->years_in_business) }}">

                                @error('years_in_business')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="mb-4">

                                <label class="form-label fw-semibold">Staff Count</label>

                                <input type="number" name="staff_count" min="0"
                                    class="form-control @error('staff_count') is-invalid @enderror"
                                    value="{{ old('staff_count', $company->staff_count) }}">

                                @error('staff_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="mb-4">

                                <label class="form-label fw-semibold">Annual Turnover</label>

                                <input type="text" name="annual_turnover" placeholder="e.g. $1M - $5M"
                                    class="form-control @error('annual_turnover') is-invalid @enderror"
                                    value="{{ old('annual_turnover', $company->annual_turnover) }}">

                                @error('annual_turnover')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="mb-4">

                                <label class="form-label fw-semibold">Response Rate (%)</label>

                                <input type="number" name="response_rate" min="0" max="100"
                                    class="form-control @error('response_rate') is-invalid @enderror"
                                    value="{{ old('response_rate', $company->response_rate) }}">

                                @error('response_rate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>

                            <hr>

                            <div class="d-grid">

                                <button class="btn btn-success btn-lg">

                                    <i class="bi bi-check-circle me-2"></i>

                                    Save Changes

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

    <script>
        const stateSelect = document.getElementById('state_id');
        const citySelect = document.getElementById('city_id');
        const countrySelect = document.getElementById('country_id');

        const allStates = Array.from(stateSelect.options).slice(1);
        const allCities = Array.from(citySelect.options).slice(1);

        function filterStates() {
            const countryId = countrySelect.value;
            const currentState = stateSelect.value;

            stateSelect.innerHTML = '<option value="">Select State</option>';

            allStates
                .filter((opt) => !countryId || opt.dataset.country === countryId)
                .forEach((opt) => stateSelect.appendChild(opt.cloneNode(true)));

            if ([...stateSelect.options].some((o) => o.value === currentState)) {
                stateSelect.value = currentState;
            }
        }

        function filterCities() {
            const stateId = stateSelect.value;
            const currentCity = citySelect.value;

            citySelect.innerHTML = '<option value="">Select City</option>';

            allCities
                .filter((opt) => !stateId || opt.dataset.state === stateId)
                .forEach((opt) => citySelect.appendChild(opt.cloneNode(true)));

            if ([...citySelect.options].some((o) => o.value === currentCity)) {
                citySelect.value = currentCity;
            }
        }

        countrySelect.addEventListener('change', () => {
            filterStates();
            filterCities();
        });

        stateSelect.addEventListener('change', filterCities);

        filterStates();
        filterCities();
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
            min-height: 120px;
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

        .card-body {
            padding: 28px;
        }
    </style>

@endsection
