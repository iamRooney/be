<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            At a Glance

        </h5>

    </div>

    <div class="card-body">

        <div class="d-flex justify-content-between mb-3">

            <span>Status</span>

            @if ($requirement->status == 'open')
                <span class="badge bg-success">Open</span>
            @elseif($requirement->status == 'accepted')
                <span class="badge bg-info">Accepted</span>
            @else
                <span class="badge bg-secondary">Closed</span>
            @endif

        </div>

        <div class="d-flex justify-content-between mb-3">

            <span>Buyer</span>

            <strong>{{ $requirement->buyer->name ?? '-' }}</strong>

        </div>

        <div class="d-flex justify-content-between mb-3">

            <span>Accepted By</span>

            <strong>{{ $requirement->acceptedByCompany->name ?? '—' }}</strong>

        </div>

        <div class="d-flex justify-content-between">

            <span>Posted</span>

            <strong>{{ $requirement->created_at->diffForHumans() }}</strong>

        </div>

    </div>

</div>
