<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body">

        <div class="d-flex">

            <div class="company-avatar">

                {{ strtoupper(substr($company->name, 0, 1)) }}

            </div>

            <div class="ms-4">

                <h4 class="fw-bold mb-1">

                    {{ $company->name }}

                </h4>

                <p class="text-muted mb-2">

                    {{ $company->city->name ?? 'Location not set' }}

                </p>

                @if ($company->verified)
                    <span class="badge bg-success">
                        Verified Company
                    </span>
                @else
                    <span class="badge bg-warning text-dark">
                        Pending Verification
                    </span>
                @endif

            </div>

        </div>

        <hr>

        <div class="row">

            <div class="col-md-6">

                <p class="mb-2">

                    <strong>Owner</strong>

                </p>

                <p>{{ $company->user->name ?? 'Not linked to a user account' }}</p>

            </div>

            <div class="col-md-6">

                <p class="mb-2">

                    <strong>GST Number</strong>

                </p>

                <p>{{ $company->gst_number ?? 'Not provided' }}</p>

            </div>

            <div class="col-md-6">

                <p class="mb-2">

                    <strong>Email</strong>

                </p>

                <p>{{ $company->email }}</p>

            </div>

            <div class="col-md-6">

                <p class="mb-2">

                    <strong>Phone</strong>

                </p>

                <p>{{ $company->phone }}</p>

            </div>

        </div>

    </div>

</div>

<style>
    .company-avatar {

        width: 90px;

        height: 90px;

        border-radius: 18px;

        background: linear-gradient(135deg, #2563eb, #4f46e5);

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 36px;

        font-weight: 700;

        color: white;

    }
</style>
