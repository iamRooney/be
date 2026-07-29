<div class="card border-0 shadow-sm rounded-4 h-100">

    <div class="card-header bg-white border-0">

        <h5 class="fw-bold mb-0">

            Recent Listings

        </h5>

    </div>

    <div class="card-body">

        @forelse ($recentListings as $listing)
            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

                <div>

                    <div class="fw-semibold">

                        {{ $listing->name }}

                    </div>

                    <small class="text-muted">

                        {{ $listing->type }}

                    </small>

                </div>

                <span class="badge bg-{{ $listing->status == 'Approved' ? 'success' : 'warning text-dark' }}">

                    {{ $listing->status }}

                </span>

            </div>
        @empty
            <p class="text-muted mb-0">No listings yet.</p>
        @endforelse

    </div>

</div>
