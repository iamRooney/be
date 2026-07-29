<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            Personal Information

        </h5>

    </div>

    <div class="card-body">

        <table class="table mb-0">

            <tr>

                <th width="35%">Full Name</th>

                <td>{{ $user->name }}</td>

            </tr>

            <tr>

                <th>Email</th>

                <td>{{ $user->email ?? '—' }}</td>

            </tr>

            <tr>

                <th>Phone</th>

                <td>{{ $user->phone }}</td>

            </tr>

            <tr>

                <th>Role</th>

                <td>{{ ucfirst($user->role ?? 'buyer') }}</td>

            </tr>

            <tr>

                <th>Company</th>

                <td>{{ $user->company->name ?? '-' }}</td>

            </tr>

            <tr>

                <th>Location</th>

                <td>
                    {{ $user->company?->city?->name }}{{ $user->company?->city && $user->company?->state ? ', ' : '' }}{{ $user->company?->state?->name ?? '-' }}
                </td>

            </tr>

        </table>

    </div>

</div>
