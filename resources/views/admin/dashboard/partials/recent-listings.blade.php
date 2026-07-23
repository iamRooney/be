<div class="card border-0 shadow-sm rounded-4 h-100">

    <div class="card-header bg-white border-0">

        <h5 class="fw-bold mb-0">

            Recent Listings

        </h5>

    </div>

    <div class="card-body">

        @foreach ([['Arduino UNO', 'Product', 'Pending'], ['Industrial Pump', 'Product', 'Approved'], ['CNC Cutting', 'Service', 'Pending'], ['Website Development', 'Service', 'Approved']] as $listing)
            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">

                <div>

                    <div class="fw-semibold">

                        {{ $listing[0] }}

                    </div>

                    <small class="text-muted">

                        {{ $listing[1] }}

                    </small>

                </div>

                <span class="badge bg-{{ $listing[2] == 'Approved' ? 'success' : 'warning text-dark' }}">

                    {{ $listing[2] }}

                </span>

            </div>
        @endforeach

    </div>

</div>
