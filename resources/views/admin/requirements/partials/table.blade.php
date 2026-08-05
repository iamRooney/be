<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">

        <div>
            <h5 class="fw-bold mb-1">All Requirements</h5>
            <small class="text-muted">
                Showing {{ $requirements->count() }} of {{ $requirements->total() }} requirements
            </small>
        </div>

        <button class="btn btn-outline-secondary btn-sm" onclick="window.location.reload()">
            <i class="bi bi-arrow-clockwise"></i>
        </button>

    </div>

    <div class="table-responsive">

        <table class="table align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th>RFQ</th>

                    <th>Buyer</th>

                    <th>Category</th>

                    <th>Quantity</th>

                    <th>Date</th>

                    <th>Status</th>

                    <th>Accepted By</th>

                    <th width="140" class="text-center">Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse ($requirements as $requirement)
                    <tr>

                        <td>

                            <div class="fw-semibold">
                                {{ $requirement->requirement_number }}
                            </div>

                            <small class="text-muted">
                                {{ $requirement->title }}
                            </small>

                        </td>

                        <td>{{ $requirement->buyer->name ?? '-' }}</td>

                        <td>{{ $requirement->category->name ?? '-' }}</td>

                        <td>{{ number_format($requirement->quantity) }} {{ $requirement->unit }}</td>

                        <td>{{ $requirement->created_at->diffForHumans() }}</td>

                        <td>

                            @if ($requirement->status == 'open')
                                <span class="badge bg-success-subtle text-success">
                                    Open
                                </span>
                            @elseif($requirement->status == 'accepted')
                                <span class="badge bg-info-subtle text-info">
                                    Accepted
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">
                                    Closed
                                </span>
                            @endif

                        </td>

                        <td>{{ $requirement->acceptedByCompany->name ?? '-' }}</td>

                        <td class="text-center">

                            <div class="d-flex align-items-center justify-content-center gap-1" role="group">

                                {{-- View --}}
                                <a href="{{ route('admin.requirements.show', $requirement) }}"
                                    class="btn btn-sm btn-info" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- Toggle Status --}}
                                <form action="{{ route('admin.requirements.update', $requirement) }}" method="POST"
                                    onsubmit="return confirm('{{ $requirement->status == 'closed' ? 'Reopen this requirement? It will become visible to matching sellers again.' : 'Close this requirement? It will stop showing up for sellers.' }}')">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status"
                                        value="{{ $requirement->status == 'closed' ? 'open' : 'closed' }}">
                                    <button type="submit"
                                        class="btn btn-sm {{ $requirement->status == 'closed' ? 'btn-outline-success' : 'btn-success' }}"
                                        title="{{ $requirement->status == 'closed' ? 'Reopen' : 'Mark Closed' }}">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>

                                {{-- Delete --}}
                                <form action="{{ route('admin.requirements.destroy', $requirement) }}"
                                    method="POST" onsubmit="return confirm('Delete this requirement?')">
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
                        <td colspan="8" class="text-center py-5">
                            <i class="bi bi-file-earmark-text display-5 text-muted"></i>
                            <h5 class="mt-3">No Requirements Found</h5>
                            <p class="text-muted mb-0">There are currently no requirements matching your filters.
                            </p>
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    @if ($requirements->hasPages())
        <div class="card-footer bg-white">
            {{ $requirements->links() }}
        </div>
    @endif

</div>
