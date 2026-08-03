<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">

        <div>
            <h5 class="fw-bold mb-1">All Companies</h5>
            <small class="text-muted">
                Showing {{ $companies->firstItem() ?? 0 }}-{{ $companies->lastItem() ?? 0 }} of
                {{ $companies->total() }} companies
            </small>
        </div>

        <div class="d-flex gap-2">

            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-funnel"></i>
            </button>

            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-clockwise"></i>
            </button>

        </div>

    </div>

    <div class="table-responsive">

        <table class="table align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th width="40">
                        <input type="checkbox" class="form-check-input">
                    </th>

                    <th>Company</th>

                    <th>Owner</th>

                    <th>Contact</th>

                    <th>Location</th>

                    <th>Joined</th>

                    <th>Status</th>

                    <th width="80" class="text-center">Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse ($companies as $company)
                    <tr>

                        <td>

                            <input type="checkbox" class="form-check-input">

                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <div class="company-logo me-3">

                                    @if ($company->logo_url)
                                        <img src="{{ $company->logo_url }}" alt="{{ $company->name }}">
                                    @else
                                        {{ strtoupper(substr($company->name, 0, 1)) }}
                                    @endif

                                </div>

                                <div>

                                    <div class="fw-semibold">

                                        {{ $company->name }}

                                    </div>

                                    <small class="text-muted">

                                        ID #CMP{{ str_pad($company->id, 4, '0', STR_PAD_LEFT) }}

                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>{{ $company->user->name ?? '—' }}</td>

                        <td>{{ $company->phone ?? '—' }}</td>

                        <td>{{ $company->city->name ?? '—' }}</td>

                        <td>{{ $company->created_at->diffForHumans() }}</td>

                        <td>

                            @if ($company->verified)
                                <span class="badge bg-success-subtle text-success px-3 py-2">

                                    Verified

                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-warning px-3 py-2">

                                    Pending

                                </span>
                            @endif

                        </td>

                        <td class="text-center">

                            <div class="dropdown">

                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">

                                    <i class="bi bi-three-dots"></i>

                                </button>

                                <ul class="dropdown-menu dropdown-menu-end shadow">

                                    <li>

                                        <a class="dropdown-item" href="{{ route('admin.companies.show', $company) }}">

                                            <i class="bi bi-eye me-2"></i>

                                            View

                                        </a>

                                    </li>

                                    @if (!$company->verified)
                                        <li>

                                            <form action="{{ route('admin.companies.toggle-verified', $company) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="dropdown-item text-success">
                                                    <i class="bi bi-patch-check me-2"></i>
                                                    Verify
                                                </button>
                                            </form>

                                        </li>
                                    @else
                                        <li>

                                            <form action="{{ route('admin.companies.toggle-verified', $company) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bi bi-x-circle me-2"></i>
                                                    Unverify
                                                </button>
                                            </form>

                                        </li>
                                    @endif

                                </ul>

                            </div>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">No companies found.</td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer bg-white">

        {{ $companies->links() }}

    </div>

</div>

<style>
    .company-logo {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2563eb, #4f46e5);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 18px;
        overflow: hidden;
    }

    .company-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .table tbody tr {
        transition: .2s;
    }

    .table tbody tr:hover {
        background: #f8fafc;
    }

    .badge {
        font-size: .75rem;
        font-weight: 600;
    }
</style>
