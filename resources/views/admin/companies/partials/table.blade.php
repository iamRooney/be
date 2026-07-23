<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">

        <div>
            <h5 class="fw-bold mb-1">All Companies</h5>
            <small class="text-muted">Showing 10 of 1,284 companies</small>
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

                    <th>Business</th>

                    <th>Location</th>

                    <th>Joined</th>

                    <th>Status</th>

                    <th width="80" class="text-center">Actions</th>

                </tr>

            </thead>

            <tbody>

                @php

                    $companies = [
                        [
                            'company' => 'ABC Electronics',
                            'owner' => 'Rahul Nair',
                            'business' => 'Manufacturer',
                            'city' => 'Kochi',
                            'joined' => '2 days ago',
                            'status' => 'Verified',
                        ],

                        [
                            'company' => 'Prime Industries',
                            'owner' => 'Sanjay Kumar',
                            'business' => 'Wholesaler',
                            'city' => 'Thrissur',
                            'joined' => '4 days ago',
                            'status' => 'Pending',
                        ],

                        [
                            'company' => 'Global Steel',
                            'owner' => 'Arun Joseph',
                            'business' => 'Exporter',
                            'city' => 'Coimbatore',
                            'joined' => '1 week ago',
                            'status' => 'Rejected',
                        ],

                        [
                            'company' => 'Tech Solutions',
                            'owner' => 'Anil Das',
                            'business' => 'Service Provider',
                            'city' => 'Bangalore',
                            'joined' => '2 weeks ago',
                            'status' => 'Verified',
                        ],

                        [
                            'company' => 'Green Agro',
                            'owner' => 'Vishnu P',
                            'business' => 'Retailer',
                            'city' => 'Palakkad',
                            'joined' => '3 weeks ago',
                            'status' => 'Pending',
                        ],
                    ];

                @endphp

                @foreach ($companies as $company)
                    <tr>

                        <td>

                            <input type="checkbox" class="form-check-input">

                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <div class="company-logo me-3">

                                    {{ strtoupper(substr($company['company'], 0, 1)) }}

                                </div>

                                <div>

                                    <div class="fw-semibold">

                                        {{ $company['company'] }}

                                    </div>

                                    <small class="text-muted">

                                        ID #CMP{{ rand(1000, 9999) }}

                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>{{ $company['owner'] }}</td>

                        <td>{{ $company['business'] }}</td>

                        <td>{{ $company['city'] }}</td>

                        <td>{{ $company['joined'] }}</td>

                        <td>

                            @if ($company['status'] == 'Verified')
                                <span class="badge bg-success-subtle text-success px-3 py-2">

                                    Verified

                                </span>
                            @elseif($company['status'] == 'Pending')
                                <span class="badge bg-warning-subtle text-warning px-3 py-2">

                                    Pending

                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger px-3 py-2">

                                    Rejected

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

                                        <a class="dropdown-item" href="{{ route('admin.companies.show', 1) }}">

                                            <i class="bi bi-eye me-2"></i>

                                            View

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item text-success" href="#">

                                            <i class="bi bi-patch-check me-2"></i>

                                            Verify

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item text-danger" href="#">

                                            <i class="bi bi-x-circle me-2"></i>

                                            Reject

                                        </a>

                                    </li>

                                </ul>

                            </div>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>

    <div class="card-footer bg-white">

        <nav>

            <ul class="pagination justify-content-end mb-0">

                <li class="page-item disabled">

                    <a class="page-link">Previous</a>

                </li>

                <li class="page-item active">

                    <a class="page-link">1</a>

                </li>

                <li class="page-item">

                    <a class="page-link">2</a>

                </li>

                <li class="page-item">

                    <a class="page-link">3</a>

                </li>

                <li class="page-item">

                    <a class="page-link">Next</a>

                </li>

            </ul>

        </nav>

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
