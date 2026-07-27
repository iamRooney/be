<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            Seller Information

        </h5>

    </div>

    <div class="card-body">

        @php
            $company = $product->company;
        @endphp

        <div class="d-flex align-items-center mb-4">

            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold fs-4"
                style="width:70px;height:70px;">

                {{ strtoupper(substr($company->name ?? 'C', 0, 1)) }}

            </div>

            <div class="ms-3">

                <h5 class="mb-1">

                    {{ $company->name ?? 'Unknown Company' }}

                </h5>

                <span class="badge bg-success">

                    Verified Company

                </span>

            </div>

        </div>

        <table class="table table-borderless table-sm mb-0">

            <tr>

                <th width="35%">Company</th>

                <td>{{ $company->name ?? 'N/A' }}</td>

            </tr>

            <tr>

                <th>Owner</th>

                <td>{{ $company->owner_name ?? 'Not Available' }}</td>

            </tr>

            <tr>

                <th>Email</th>

                <td>{{ $company->email ?? 'Not Available' }}</td>

            </tr>

            <tr>

                <th>Phone</th>

                <td>{{ $company->phone ?? 'Not Available' }}</td>

            </tr>

            <tr>

                <th>Address</th>

                <td>{{ $company->address ?? 'Not Available' }}</td>

            </tr>

            <tr>

                <th>City</th>

                <td>{{ $company->city->name ?? 'Not Available' }}</td>

            </tr>

            <tr>

                <th>Joined</th>

                <td>

                    {{ $company->created_at?->format('d M Y') ?? 'N/A' }}

                </td>

            </tr>

            <tr>

                <th>Status</th>

                <td>

                    @if ($company->status ?? false)
                        <span class="badge bg-success">

                            Active

                        </span>
                    @else
                        <span class="badge bg-secondary">

                            Inactive

                        </span>
                    @endif

                </td>

            </tr>

        </table>

    </div>

</div>
