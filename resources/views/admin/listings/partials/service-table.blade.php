<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white border-0">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h5 class="fw-bold mb-1">
                    Services
                </h5>

                <small class="text-muted">
                    Showing {{ $services->count() }} of {{ $services->total() }} services
                </small>

            </div>

            <a href="{{ route('admin.listings.services.index') }}" class="btn btn-outline-secondary btn-sm">

                <i class="bi bi-arrow-clockwise"></i>

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

                    <th>Service</th>

                    <th>Company</th>

                    <th>Category</th>

                    <th>Status</th>

                    <th>Featured</th>

                    <th width="90">Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse($services as $service)
                    <tr>

                        <td>
                            <input type="checkbox" class="form-check-input">
                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <img src="{{ $service->image ? asset('storage/' . $service->image) : 'https://placehold.co/60x60?text=No+Image' }}"
                                    class="rounded me-3" style="width:60px;height:60px;object-fit:cover;">

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

                            @if ($service->featured)
                                <span class="badge bg-primary">

                                    Featured

                                </span>
                            @else
                                <span class="badge bg-light text-dark border">

                                    Normal

                                </span>
                            @endif

                        </td>

                        <td>

                            <div class="dropdown">

                                <button class="btn btn-light btn-sm" data-bs-toggle="dropdown">

                                    <i class="bi bi-three-dots"></i>

                                </button>

                                <ul class="dropdown-menu dropdown-menu-end">

                                    <li>

                                        <a class="dropdown-item"
                                            href="{{ route('admin.listings.services.show', $service) }}">

                                            <i class="bi bi-eye me-2"></i>

                                            View

                                        </a>

                                    </li>

                                </ul>

                            </div>

                        </td>

                    </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center py-5">

                                <i class="bi bi-briefcase fs-1 text-muted"></i>

                                <h5 class="mt-3">

                                    No Services Found

                                </h5>

                                <p class="text-muted mb-0">

                                    No services match the selected filters.

                                </p>

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        @if ($services->hasPages())
            <div class="card-footer bg-white">

                {{ $services->links() }}

            </div>
        @endif

    </div>
