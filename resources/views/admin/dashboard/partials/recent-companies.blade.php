<div class="card border-0 shadow-sm rounded-4 h-100">

    <div class="card-header bg-white border-0 d-flex justify-content-between">

        <h5 class="fw-bold mb-0">
            Recent Companies
        </h5>

        <a href="#" class="small text-decoration-none">
            View All
        </a>

    </div>

    <div class="card-body">

        @forelse ($recentCompanies as $company)
            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

                <div>

                    <div class="fw-semibold">
                        {{ $company->name }}
                    </div>

                    <small class="text-muted">
                        {{ $company->created_at->diffForHumans() }}
                    </small>

                </div>

                <span class="badge bg-{{ $company->verified ? 'success' : 'warning text-dark' }}">
                    {{ $company->verified ? 'Verified' : 'Pending' }}
                </span>

            </div>
        @empty
            <p class="text-muted mb-0">No companies yet.</p>
        @endforelse

    </div>

</div>
