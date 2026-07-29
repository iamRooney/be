<div class="card border-0 shadow-sm rounded-4 h-100">

    <div class="card-header bg-white border-0">

        <h5 class="fw-bold mb-0">
            Recent Enquiries
        </h5>

    </div>

    <div class="table-responsive">

        <table class="table align-middle mb-0">

            <thead>

                <tr>

                    <th>Buyer</th>

                    <th>Seller</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                @forelse ($recentEnquiries as $enquiry)
                    <tr>

                        <td>{{ $enquiry->buyer->name ?? 'N/A' }}</td>

                        <td>{{ $enquiry->company->name ?? 'N/A' }}</td>

                        <td>
                            <span class="badge bg-{{ $enquiry->status === 'open' ? 'success' : 'secondary' }}">
                                {{ ucfirst($enquiry->status) }}
                            </span>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-muted text-center">No enquiries yet.</td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>
