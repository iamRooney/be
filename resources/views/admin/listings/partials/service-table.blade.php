<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white border-0">
        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h5 class="fw-bold mb-1">Services</h5>
                <small class="text-muted">
                    Showing {{ $services->count() }} of {{ $services->total() }} services
                </small>
            </div>

            <button class="btn btn-outline-secondary btn-sm rounded-pill" onclick="window.location.reload()">

                <i class="bi bi-arrow-clockwise me-1"></i>
                Refresh

            </button>

        </div>
    </div>

    <div class="table-responsive">

        <table class="table align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th width="60">#</th>
                    <th>Service</th>
                    <th>Company</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th width="260">Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse($services as $service)
                    <tr>

                        <td>
                            {{ $services->firstItem() + $loop->index }}
                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <img src="{{ $service->image ? asset('storage/' . $service->image) : 'https://placehold.co/60x60' }}"
                                    width="60" height="60" class="rounded me-3" style="object-fit:cover">

                                <div>

                                    <div class="fw-semibold">

                                        {{ $service->name }}

                                    </div>

                                    <small class="text-muted">

                                        #{{ $service->id }}

                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>

                            {{ $service->company->name ?? '-' }}

                        </td>

                        <td>

                            {{ $service->category->name ?? '-' }}

                        </td>

                        <td>

                            @if ($service->featured)
                                <span class="badge bg-primary">

                                    Featured

                                </span>
                            @else
                                <span class="badge bg-secondary">

                                    No

                                </span>
                            @endif

                        </td>

                        <td>

                            @switch($service->status)
                                @case('approved')
                                    <span class="badge bg-success">

                                        Approved

                                    </span>
                                @break

                                @case('pending')
                                    <span class="badge bg-warning text-dark">

                                        Pending

                                    </span>
                                @break

                                @case('rejected')
                                    <span class="badge bg-danger">

                                        Rejected

                                    </span>
                                @break

                                @default
                                    <span class="badge bg-secondary">

                                        {{ ucfirst($service->status) }}

                                    </span>
                            @endswitch

                        </td>

                        <td>

                            <div class="d-flex align-items-center gap-1" role="group">

                                {{-- View --}}
                                <a href="{{ route('admin.listings.services.show', $service) }}"
                                    class="btn btn-sm btn-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- Approve --}}
                                @if ($service->status != 'approved')
                                    <form action="{{ route('admin.listings.services.approve', $service) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-success" title="Approve">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                @endif

                                {{-- Reject --}}
                                @if ($service->status != 'rejected')
                                    <form action="{{ route('admin.listings.services.reject', $service) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-warning" title="Reject">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>
                                @endif

                                {{-- Feature --}}
                                <form action="{{ route('admin.listings.services.feature', $service) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        class="btn btn-sm {{ $service->featured ? 'btn-primary' : 'btn-outline-primary' }}"
                                        title="Toggle Featured">
                                        <i class="bi bi-star{{ $service->featured ? '-fill' : '' }}"></i>
                                    </button>
                                </form>

                                {{-- Delete --}}
                                <form action="{{ route('admin.listings.services.destroy', $service) }}" method="POST"
                                    onsubmit="return confirm('Delete this service?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center py-5">

                                <i class="bi bi-briefcase display-5 text-muted"></i>

                                <h5 class="mt-3">

                                    No Services Found

                                </h5>

                                <p class="text-muted mb-0">

                                    There are currently no services matching your filters.

                                </p>

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        @if ($services->hasPages())
            <div class="card-footer bg-white">

                {{ $services->withQueryString()->links() }}

            </div>
        @endif

    </div>
