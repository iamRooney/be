<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">
            Service Information
        </h5>

    </div>

    <div class="card-body">

        <table class="table table-borderless align-middle mb-0">

            <tr>
                <th width="35%">Service Name</th>
                <td>{{ $service->name }}</td>
            </tr>

            <tr>
                <th>Slug</th>
                <td><code>{{ $service->slug }}</code></td>
            </tr>

            <tr>
                <th>Company</th>
                <td>{{ $service->company->name ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Category</th>
                <td>{{ $service->category->name ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>Starting Price</th>
                <td>
                    {{ $service->starting_price ? '₹' . number_format($service->starting_price, 2) : 'Not Specified' }}
                </td>
            </tr>

            <tr>
                <th>Service Area</th>
                <td>{{ $service->service_area ?? 'Not Specified' }}</td>
            </tr>

            <tr>
                <th>Experience</th>
                <td>{{ $service->experience ?? 'Not Specified' }}</td>
            </tr>

            <tr>
                <th>Availability</th>
                <td>{{ $service->availability ?? 'Not Specified' }}</td>
            </tr>

            <tr>
                <th>Featured</th>
                <td>
                    @if ($service->featured)
                        <span class="badge bg-primary">Featured</span>
                    @else
                        <span class="badge bg-secondary">No</span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Status</th>
                <td>

                    @switch($service->status)
                        @case('approved')
                            <span class="badge bg-success">Approved</span>
                        @break

                        @case('pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @break

                        @case('rejected')
                            <span class="badge bg-danger">Rejected</span>
                        @break

                        @default
                            <span class="badge bg-secondary">
                                {{ ucfirst($service->status) }}
                            </span>
                    @endswitch

                </td>
            </tr>

            <tr>
                <th>Created</th>
                <td>{{ $service->created_at?->format('d M Y, h:i A') }}</td>
            </tr>

            <tr>
                <th>Updated</th>
                <td>{{ $service->updated_at?->format('d M Y, h:i A') }}</td>
            </tr>

        </table>

    </div>

</div>
