<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-header bg-white border-0">

        <h5 class="fw-bold mb-0">

            Product Gallery

        </h5>

    </div>

    <div class="card-body">

        @php
            $image = $product->image
                ? asset('storage/' . $product->image)
                : 'https://placehold.co/900x450?text=No+Image';
        @endphp

        <img src="{{ $image }}" alt="{{ $product->name }}" class="img-fluid rounded border mb-3 w-100"
            style="max-height:500px;object-fit:contain;background:#f8f9fa;">

        <div class="row g-2">

            <div class="col-3">

                <img src="{{ $image }}" class="img-fluid rounded border"
                    style="height:100px;width:100%;object-fit:cover;cursor:pointer;">

            </div>

        </div>

        <div class="mt-3">

            <small class="text-muted">

                Uploaded on
                <strong>{{ $product->created_at->format('d M Y, h:i A') }}</strong>

            </small>

        </div>

    </div>

</div>
