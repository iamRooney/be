<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            Moderation Panel

        </h5>

    </div>

    <div class="card-body">

        <div class="mb-4">

            <h6 class="fw-semibold mb-3">

                Listing Status

            </h6>

            @switch($product->status)
                @case('approved')
                    <span class="badge bg-success fs-6">
                        Approved
                    </span>
                @break

                @case('pending')
                    <span class="badge bg-warning text-dark fs-6">
                        Pending Review
                    </span>
                @break

                @case('rejected')
                    <span class="badge bg-danger fs-6">
                        Rejected
                    </span>
                @break

                @default
                    <span class="badge bg-secondary fs-6">
                        {{ ucfirst($product->status) }}
                    </span>
            @endswitch

        </div>

        <div class="mb-4">

            <h6 class="fw-semibold mb-2">

                Listing Visibility

            </h6>

            @if ($product->featured)
                <span class="badge bg-primary">

                    Featured Listing

                </span>
            @else
                <span class="badge bg-secondary">

                    Normal Listing

                </span>
            @endif

        </div>

        <div class="mb-4">

            <small class="text-muted d-block">

                Submitted

            </small>

            <strong>

                {{ $product->created_at?->format('d M Y, h:i A') }}

            </strong>

        </div>

        <div class="d-grid gap-2">

            @if ($product->status != 'approved')
                <form method="POST" action="{{ route('admin.listings.products.approve', $product) }}">

                    @csrf
                    @method('PATCH')

                    <button class="btn btn-success w-100">

                        <i class="bi bi-check-circle me-2"></i>

                        Approve Product

                    </button>

                </form>
            @endif

            @if ($product->status != 'rejected')
                <form method="POST" action="{{ route('admin.listings.products.reject', $product) }}">

                    @csrf
                    @method('PATCH')

                    <button class="btn btn-danger w-100">

                        <i class="bi bi-x-circle me-2"></i>

                        Reject Product

                    </button>

                </form>
            @endif

            <form method="POST" action="{{ route('admin.listings.products.feature', $product) }}">

                @csrf
                @method('PATCH')

                <button class="btn btn-warning text-white w-100">

                    <i class="bi bi-star-fill me-2"></i>

                    {{ $product->featured ? 'Remove Featured' : 'Mark as Featured' }}

                </button>

            </form>

            <form method="POST" action="{{ route('admin.listings.products.destroy', $product) }}"
                onsubmit="return confirm('Delete this product permanently?');">

                @csrf
                @method('DELETE')

                <button class="btn btn-outline-danger w-100">

                    <i class="bi bi-trash me-2"></i>

                    Delete Product

                </button>

            </form>

        </div>

    </div>

</div>
