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

        @foreach ([['ABC Electronics', 'Pending', '2 mins ago'], ['Kerala Traders', 'Verified', '15 mins ago'], ['Global Steel', 'Pending', '35 mins ago'], ['Prime Industries', 'Verified', '1 hour ago']] as $company)
            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

                <div>

                    <div class="fw-semibold">
                        {{ $company[0] }}
                    </div>

                    <small class="text-muted">
                        {{ $company[2] }}
                    </small>

                </div>

                <span class="badge bg-{{ $company[1] == 'Verified' ? 'success' : 'warning text-dark' }}">
                    {{ $company[1] }}
                </span>

            </div>
        @endforeach

    </div>

</div>
