<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            Requirement Details

        </h5>

    </div>

    <div class="card-body">

        <div class="row g-4">

            <div class="col-sm-6">
                <small class="text-muted d-block">Product / Service</small>
                <div class="fw-semibold">{{ $requirement->title }}</div>
            </div>

            <div class="col-sm-6">
                <small class="text-muted d-block">Category</small>
                <div class="fw-semibold">{{ $requirement->category->name ?? '-' }}</div>
            </div>

            <div class="col-sm-6">
                <small class="text-muted d-block">Quantity</small>
                <div class="fw-semibold">{{ number_format($requirement->quantity) }} {{ $requirement->unit }}</div>
            </div>

            <div class="col-sm-6">
                <small class="text-muted d-block">Contact Number</small>
                <div class="fw-semibold">{{ $requirement->phone }}</div>
            </div>

            <div class="col-sm-6">
                <small class="text-muted d-block">Posted By</small>
                <div class="fw-semibold">{{ $requirement->buyer->name ?? '-' }}</div>
            </div>

            <div class="col-sm-6">
                <small class="text-muted d-block">Posted On</small>
                <div class="fw-semibold">{{ $requirement->created_at->format('d M Y, h:i A') }}</div>
            </div>

        </div>

        @if ($requirement->status == 'accepted')
            <hr>

            <div class="alert alert-info mb-0">

                <i class="bi bi-check-circle me-2"></i>

                Accepted by <strong>{{ $requirement->acceptedByCompany->name ?? 'a supplier' }}</strong>
                on {{ optional($requirement->accepted_at)->format('d M Y, h:i A') }}.
                The supplier now needs to message the buyer to arrange next steps.

            </div>
        @endif

    </div>

</div>
