<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white border-0">
        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h5 class="fw-bold mb-1">Products</h5>
                <small class="text-muted">
                    Showing {{ $products->count() }} of {{ $products->total() }} products
                </small>
            </div>

            <button class="btn btn-outline-secondary btn-sm rounded-pill" onclick="window.location.reload()">

                <i class="bi bi-arrow-clockwise me-1"></i>
                Refresh

            </button>

        </div>
    </div>

    <div class="table-responsive">

        <table class="table align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th width="60">#</th>
                    <th>Product</th>
                    <th>Company</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th width="260">Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse($products as $product)
                    <tr>

                        <td>
                            {{ $products->firstItem() + $loop->index }}
                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/60x60' }}"
                                    width="60" height="60" class="rounded me-3" style="object-fit:cover">

                                <div>

                                    <div class="fw-semibold">

                                        {{ $product->name }}

                                    </div>

                                    <small class="text-muted">

                                        {{ $product->slug }}

                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>

                            {{ $product->company->name ?? '-' }}

                        </td>

                        <td>

                            {{ $product->category->name ?? '-' }}

                        </td>

                        <td>

                            ₹{{ number_format($product->price, 2) }}

                        </td>

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

                        <td>

                            <div class="btn-group" role="group">

                                {{-- View --}}
                                <a href="{{ route('admin.listings.products.show', $product) }}"
                                    class="btn btn-sm btn-info" title="View">

                                    <i class="bi bi-eye"></i>

                                </a>

                                {{-- Approve --}}
                                @if ($product->status != 'approved')
                                    <form action="{{ route('admin.listings.products.approve', $product) }}"
                                        method="POST" class="d-inline">

                                        @csrf
                                        @method('PATCH')

                                        <button class="btn btn-sm btn-success" title="Approve">

                                            <i class="bi bi-check-lg"></i>

                                        </button>

                                    </form>
                                @endif

                                {{-- Reject --}}
                                @if ($product->status != 'rejected')
                                    <form action="{{ route('admin.listings.products.reject', $product) }}"
                                        method="POST" class="d-inline">

                                        @csrf
                                        @method('PATCH')

                                        <button class="btn btn-sm btn-warning" title="Reject">

                                            <i class="bi bi-x-lg"></i>

                                        </button>

                                    </form>
                                @endif

                                {{-- Feature --}}
                                <form action="{{ route('admin.listings.products.feature', $product) }}" method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        class="btn btn-sm {{ $product->featured ? 'btn-primary' : 'btn-outline-primary' }}"
                                        title="Toggle Featured">

                                        <i class="bi bi-star{{ $product->featured ? '-fill' : '' }}"></i>

                                    </button>

                                </form>

                                {{-- Delete --}}
                                <form action="{{ route('admin.listings.products.destroy', $product) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Delete this product?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger" title="Delete">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-5">

                                <i class="bi bi-box display-5 text-muted"></i>

                                <h5 class="mt-3">

                                    No Products Found

                                </h5>

                                <p class="text-muted mb-0">

                                    There are currently no products matching your filters.

                                </p>

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        @if ($products->hasPages())
            <div class="card-footer bg-white">

                {{ $products->withQueryString()->links() }}

            </div>
        @endif

    </div>
