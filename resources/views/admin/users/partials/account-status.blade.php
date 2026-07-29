<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold">

            Account Status

        </h5>

    </div>

    <div class="card-body">

        <div class="d-flex justify-content-between mb-3">

            <span>Status</span>

            @if ($user->status)
                <span class="badge bg-success">

                    Active

                </span>
            @else
                <span class="badge bg-danger">

                    Suspended

                </span>
            @endif

        </div>

        <div class="d-flex justify-content-between mb-3">

            <span>Email Verified</span>

            <span class="{{ $user->email_verified_at ? 'text-success' : 'text-muted' }}">

                {{ $user->email_verified_at ? 'Yes' : 'No' }}

            </span>

        </div>

        <div class="d-flex justify-content-between">

            <span>Phone Verified</span>

            <span class="{{ $user->otp_verified_at ? 'text-success' : 'text-muted' }}">

                {{ $user->otp_verified_at ? 'Yes' : 'No' }}

            </span>

        </div>

    </div>

</div>
