<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold">

            Verification

        </h5>

    </div>

    <div class="card-body">

        <div class="d-flex justify-content-between mb-3">

            <span>Status</span>

            @if ($company->verified)
                <span class="badge bg-success">
                    Verified
                </span>
            @else
                <span class="badge bg-warning">
                    Pending
                </span>
            @endif

        </div>

        <div class="d-flex justify-content-between mb-3">

            <span>GST Number</span>

            <span class="{{ $company->gst_number ? 'text-success' : 'text-muted' }}">

                {{ $company->gst_number ? 'Provided' : 'Not provided' }}

            </span>

        </div>

        <div class="d-flex justify-content-between">

            <span>Account Status</span>

            <span class="{{ $company->status ? 'text-success' : 'text-danger' }}">

                {{ $company->status ? 'Active' : 'Inactive' }}

            </span>

        </div>

    </div>

</div>
