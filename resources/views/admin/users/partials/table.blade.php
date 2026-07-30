<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">

        <div>
            <h5 class="fw-bold mb-1">All Users</h5>
            <small class="text-muted">
                Showing {{ $users->count() }} of {{ $users->total() }} users
            </small>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-funnel"></i>
            </button>

            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-clockwise"></i>
            </a>
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

                @forelse ($users as $user)
                    <tr>

                        <td>
                            <input class="form-check-input" type="checkbox">
                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <div class="user-avatar">

                                    @if ($user->profile_image_url)
                                        <img src="{{ $user->profile_image_url }}" alt="{{ $user->name }}"
                                            style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                                    @else
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    @endif

                                </div>

                                <div class="ms-3">

                                    <div class="fw-semibold">

                                        {{ $user->name }}

                                    </div>

                                    <small class="text-muted">

                                        {{ $user->email ?? '—' }}

                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>

                            @if ($user->role === 'seller')
                                <span class="badge bg-primary-subtle text-primary">

                                    Seller

                                </span>
                            @else
                                <span class="badge bg-success-subtle text-success">

                                    {{ ucfirst($user->role ?? 'buyer') }}

                                </span>
                            @endif

                        </td>

                        <td>

                            {{ $user->company->name ?? '-' }}

                        </td>

                        <td>

                            {{ $user->phone }}

                        </td>

                        <td>

                            {{ $user->created_at->diffForHumans() }}

                        </td>

                        <td>

                            @if ($user->status)
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

                                        <a class="dropdown-item" href="{{ route('admin.users.show', $user) }}">

                                            <i class="bi bi-eye me-2"></i>

                                            View Profile

                                        </a>

                                    </li>

                                    <li>

                                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">

                                            @csrf
                                            @method('PATCH')

                                            @if ($user->status)
                                                <button type="submit" class="dropdown-item text-warning">

                                                    <i class="bi bi-pause-circle me-2"></i>

                                                    Suspend

                                                </button>
                                            @else
                                                <button type="submit" class="dropdown-item text-success">

                                                    <i class="bi bi-check-circle me-2"></i>

                                                    Activate

                                                </button>
                                            @endif

                                        </form>

                                    </li>

                                </ul>

                            </div>

                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            No users found.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer bg-white">

        {{ $users->links() }}

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
