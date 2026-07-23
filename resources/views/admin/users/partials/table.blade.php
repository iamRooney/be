<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">

        <div>
            <h5 class="fw-bold mb-1">All Users</h5>
            <small class="text-muted">Showing 10 of 2,540 users</small>
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
                        <input class="form-check-input" type="checkbox">
                    </th>

                    <th>User</th>

                    <th>Role</th>

                    <th>Company</th>

                    <th>Phone</th>

                    <th>Joined</th>

                    <th>Status</th>

                    <th width="80" class="text-center">Actions</th>

                </tr>

            </thead>

            <tbody>

                @php

                    $users = [
                        [
                            'name' => 'Rahul Nair',
                            'email' => 'rahul@gmail.com',
                            'role' => 'Seller',
                            'company' => 'ABC Electronics',
                            'phone' => '+91 9876543210',
                            'joined' => '2 days ago',
                            'status' => 'Active',
                        ],

                        [
                            'name' => 'Anjali Menon',
                            'email' => 'anjali@gmail.com',
                            'role' => 'Buyer',
                            'company' => '-',
                            'phone' => '+91 9876501234',
                            'joined' => '5 days ago',
                            'status' => 'Active',
                        ],

                        [
                            'name' => 'Vishnu Raj',
                            'email' => 'vishnu@gmail.com',
                            'role' => 'Seller',
                            'company' => 'Prime Industries',
                            'phone' => '+91 9898989898',
                            'joined' => '1 week ago',
                            'status' => 'Suspended',
                        ],

                        [
                            'name' => 'Arun Joseph',
                            'email' => 'arun@gmail.com',
                            'role' => 'Buyer',
                            'company' => '-',
                            'phone' => '+91 9000000000',
                            'joined' => '2 weeks ago',
                            'status' => 'Active',
                        ],
                    ];

                @endphp

                @foreach ($users as $user)
                    <tr>

                        <td>
                            <input class="form-check-input" type="checkbox">
                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <div class="user-avatar">

                                    {{ strtoupper(substr($user['name'], 0, 1)) }}

                                </div>

                                <div class="ms-3">

                                    <div class="fw-semibold">

                                        {{ $user['name'] }}

                                    </div>

                                    <small class="text-muted">

                                        {{ $user['email'] }}

                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>

                            @if ($user['role'] == 'Seller')
                                <span class="badge bg-primary-subtle text-primary">

                                    Seller

                                </span>
                            @else
                                <span class="badge bg-success-subtle text-success">

                                    Buyer

                                </span>
                            @endif

                        </td>

                        <td>

                            {{ $user['company'] }}

                        </td>

                        <td>

                            {{ $user['phone'] }}

                        </td>

                        <td>

                            {{ $user['joined'] }}

                        </td>

                        <td>

                            @if ($user['status'] == 'Active')
                                <span class="badge bg-success-subtle text-success">

                                    Active

                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger">

                                    Suspended

                                </span>
                            @endif

                        </td>

                        <td class="text-center">

                            <div class="dropdown">

                                <button class="btn btn-light btn-sm" data-bs-toggle="dropdown">

                                    <i class="bi bi-three-dots"></i>

                                </button>

                                <ul class="dropdown-menu dropdown-menu-end shadow">

                                    <li>

                                        <a class="dropdown-item" href="{{ route('admin.users.show', 1) }}">

                                            <i class="bi bi-eye me-2"></i>

                                            View Profile

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item text-warning" href="#">

                                            <i class="bi bi-pause-circle me-2"></i>

                                            Suspend

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item text-success" href="#">

                                            <i class="bi bi-check-circle me-2"></i>

                                            Activate

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

                    <a class="page-link">Next</a>

                </li>

            </ul>

        </nav>

    </div>

</div>

<style>
    .user-avatar {

        width: 48px;

        height: 48px;

        border-radius: 50%;

        background: linear-gradient(135deg, #2563eb, #4f46e5);

        display: flex;

        align-items: center;

        justify-content: center;

        font-weight: 700;

        font-size: 18px;

        color: #fff;

    }

    .table tbody tr {

        transition: .2s;

    }

    .table tbody tr:hover {

        background: #f8fafc;

    }
</style>
