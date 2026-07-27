<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">
            Service Description
        </h5>

    </div>

    <div class="card-body">

        @if ($service->description)
            <div class="text-muted" style="white-space: pre-line; line-height:1.8;">
                {{ $service->description }}
            </div>
        @elseif($service->short_description)
            <div class="text-muted" style="white-space: pre-line; line-height:1.8;">
                {{ $service->short_description }}
            </div>
        @else
            <div class="text-center py-4">

                <i class="bi bi-file-text fs-1 text-muted"></i>

                <h6 class="mt-3 mb-1">
                    No Description Available
                </h6>

                <p class="text-muted mb-0">
                    The seller has not provided a service description.
                </p>

            </div>
        @endif

    </div>

</div>
