<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">
            Product Information
        </h5>

    </div>

    <div class="card-body">

        <table class="table table-borderless align-middle mb-0">

            <tr>
                <th width="35%">Product Name</th>
                <td>{{ $product->name }}</td>
            </tr>

            <tr>
                <th>Slug</th>
                <td>
                    <code>{{ $product->slug }}</code>
                </td>
            </tr>

            <tr>
                <th>Company</th>
                <td>
                    {{ $product->company->name ?? 'N/A' }}
                </td>
            </tr>

            <tr>
                <th>Category</th>
                <td>
                    {{ $product->category->name ?? 'N/A' }}
                </td>
            </tr>

            <tr>
                <th>Price</th>
                <td>
                    ₹{{ number_format($product->price, 2) }}
                </td>
            </tr>

            <tr>
                <th>MOQ</th>
                <td>
                    {{ $product->moq ?? 'Not Specified' }}
                </td>
            </tr>

            <tr>
                <th>Featured</th>
                <td>

                    @if ($product->featured)
                        <span class="badge bg-primary">
                            Featured
                        </span>
                    @else
                        <span class="badge bg-secondary">
                            No
                        </span>
                    @endif

                </td>
            </tr>

            <tr>
                <th>Status</th>
                <td>

                    @switch($product->status)
                        @case('approved')
                            <span class="badge bg-success">
                                Approved
                            </span>
                        @break

                        @case('pending')
                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>
                        @break

                        @case('rejected')
                            <span class="badge bg-danger">
                                Rejected
                            </span>
                        @break

                        @default
                            <span class="badge bg-secondary">
                                {{ ucfirst($product->status) }}
                            </span>
                    @endswitch

                </td>
            </tr>

            <tr>
                <th>Created</th>
                <td>
                    {{ $product->created_at?->format('d M Y, h:i A') }}
                </td>
            </tr>

            <tr>
                <th>Last Updated</th>
                <td>
                    {{ $product->updated_at?->format('d M Y, h:i A') }}
                </td>
            </tr>

        </table>

    </div>

</div>
