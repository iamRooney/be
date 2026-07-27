<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">
            Service Specifications
        </h5>

    </div>

    <div class="card-body">

        <table class="table table-borderless table-sm mb-0">

            <tbody>

                <tr>
                    <th width="35%">Category</th>
                    <td>{{ $service->category->name ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Company</th>
                    <td>{{ $service->company->name ?? 'N/A' }}</td>
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
                    <td>{{ $service->featured ? 'Yes' : 'No' }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($service->status) }}</td>
                </tr>

                <tr>
                    <th>Created On</th>
                    <td>{{ $service->created_at?->format('d M Y') }}</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>
