<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">

        <div>
            <h5 class="fw-bold mb-1">All Enquiries</h5>
            <small class="text-muted">
                Showing {{ $enquiries->count() }} of {{ $enquiries->total() }} enquiries
            </small>
        </div>

        <div class="d-flex gap-2">

            <button class="btn btn-outline-secondary btn-sm" onclick="window.location.reload()">
                <i class="bi bi-arrow-clockwise"></i>
            </button>

            <a href="{{ route('admin.enquiries.index', array_merge(request()->query(), ['export' => 1])) }}"
                class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-download"></i>
            </a>

        </div>

    </div>

    <div class="table-responsive">

        <table class="table align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th width="40">
                        <input type="checkbox" class="form-check-input">
                    </th>

                    <th>Enquiry</th>

                    <th>Buyer</th>

                    <th>Seller</th>

                    <th>Listing</th>

                    <th>Date</th>

                    <th>Status</th>

                    <th>Priority</th>

                    <th width="140" class="text-center">Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse ($enquiries as $enquiry)
                    <tr>

                        <td>
                            <input type="checkbox" class="form-check-input">
                        </td>

                        <td>

                            <div class="fw-semibold">
                                {{ $enquiry->enquiry_number }}
                            </div>

                            <small class="text-muted text-capitalize">
                                {{ $enquiry->listing_type ?? '-' }}
                            </small>

                        </td>

                        <td>{{ $enquiry->buyer->name ?? '-' }}</td>

                        <td>{{ $enquiry->company->name ?? '-' }}</td>

                        <td>{{ $enquiry->listing_name ?? '-' }}</td>

                        <td>{{ $enquiry->created_at->diffForHumans() }}</td>

                        <td>

                            @if ($enquiry->status == 'open')
                                <span class="badge bg-success-subtle text-success">
                                    Open
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">
                                    Closed
                                </span>
                            @endif

                        </td>

                        <td>

                            @if ($enquiry->priority == 'high')
                                <span class="badge bg-danger">
                                    High
                                </span>
                            @elseif($enquiry->priority == 'medium')
                                <span class="badge bg-warning text-dark">
                                    Medium
                                </span>
                            @else
                                <span class="badge bg-info">
                                    Low
                                </span>
                            @endif

                        </td>

                        <td class="text-center">

                            <div class="d-flex align-items-center justify-content-center gap-1" role="group">

                                {{-- View --}}
                                <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="btn btn-sm btn-info"
                                    title="View Conversation">
                                    <i class="bi bi-chat-left-text"></i>
                                </a>

                                {{-- Toggle Status --}}
                                <form action="{{ route('admin.enquiries.update', $enquiry) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status"
                                        value="{{ $enquiry->status == 'open' ? 'closed' : 'open' }}">
                                    <button type="submit"
                                        class="btn btn-sm {{ $enquiry->status == 'open' ? 'btn-success' : 'btn-outline-success' }}"
                                        title="{{ $enquiry->status == 'open' ? 'Mark Closed' : 'Reopen' }}">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>

                                {{-- Delete --}}
                                <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST"
                                    onsubmit="return confirm('Delete this enquiry?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <i class="bi bi-chat-left-text display-5 text-muted"></i>
                            <h5 class="mt-3">No Enquiries Found</h5>
                            <p class="text-muted mb-0">There are currently no enquiries matching your filters.</p>
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    @if ($enquiries->hasPages())
        <div class="card-footer bg-white">
            {{ $enquiries->links() }}
        </div>
    @endif

</div>
