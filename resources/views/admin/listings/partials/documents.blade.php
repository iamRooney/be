<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            Attachments

        </h5>

    </div>

    <div class="card-body">

        @php
            $documents = [];

            if (!empty($product->brochure)) {
                $documents[] = [
                    'name' => 'Product Brochure',
                    'url' => asset('storage/' . $product->brochure),
                    'icon' => 'bi-file-earmark-pdf',
                ];
            }

            if (!empty($product->datasheet)) {
                $documents[] = [
                    'name' => 'Datasheet',
                    'url' => asset('storage/' . $product->datasheet),
                    'icon' => 'bi-file-earmark-text',
                ];
            }

            if (!empty($product->warranty_document)) {
                $documents[] = [
                    'name' => 'Warranty Document',
                    'url' => asset('storage/' . $product->warranty_document),
                    'icon' => 'bi-file-earmark-check',
                ];
            }
        @endphp

        @if (count($documents))

            <div class="list-group list-group-flush">

                @foreach ($documents as $document)
                    <a href="{{ $document['url'] }}" target="_blank"
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

                        <div>

                            <i class="bi {{ $document['icon'] }} me-2"></i>

                            {{ $document['name'] }}

                        </div>

                        <i class="bi bi-box-arrow-up-right"></i>

                    </a>
                @endforeach

            </div>
        @else
            <div class="text-center py-4">

                <i class="bi bi-folder2-open fs-1 text-muted"></i>

                <h6 class="mt-3 mb-1">

                    No Attachments

                </h6>

                <p class="text-muted mb-0">

                    The seller has not uploaded any supporting documents.

                </p>

            </div>

        @endif

    </div>

</div>
