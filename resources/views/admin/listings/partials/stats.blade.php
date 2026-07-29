<div class="row g-4 mb-4">

    @php

        $label = $label ?? 'Products';

        $cards = [
            ['Total ' . $label, $stats['total'], 'primary', 'box-seam'],

            ['Pending', $stats['pending'], 'warning', 'clock-history'],

            ['Approved', $stats['approved'], 'success', 'check-circle'],

            ['Rejected', $stats['rejected'], 'danger', 'x-circle'],
        ];

    @endphp

    @foreach ($cards as $card)
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">

                                {{ $card[0] }}

                            </small>

                            <h3 class="fw-bold mt-2">

                                {{ number_format($card[1]) }}

                            </h3>

                        </div>

                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                            style="width:56px;height:56px;">

                            <i class="bi bi-{{ $card[3] }} fs-4 text-{{ $card[2] }}"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    @endforeach

</div>
