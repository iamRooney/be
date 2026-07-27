<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            Specifications

        </h5>

    </div>

    <div class="card-body">

        <table class="table table-borderless table-sm mb-0">

            <tbody>

                <tr>
                    <th width="35%">Category</th>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Company</th>
                    <td>{{ $product->company->name ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Price</th>
                    <td>₹{{ number_format($product->price, 2) }}</td>
                </tr>

                <tr>
                    <th>Minimum Order Qty</th>
                    <td>{{ $product->moq ?? 'Not Specified' }}</td>
                </tr>

                <tr>
                    <th>Featured Listing</th>
                    <td>
                        {{ $product->featured ? 'Yes' : 'No' }}
                    </td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($product->status) }}</td>
                </tr>

                <tr>
                    <th>Created On</th>
                    <td>{{ $product->created_at?->format('d M Y') }}</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>
