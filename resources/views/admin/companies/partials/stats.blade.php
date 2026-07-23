<div class="row g-4 mb-4">

    @php

        $cards = [
            ['Total Companies', 1284, 'primary', 'building'],

            ['Pending', 84, 'warning', 'clock-history'],

            ['Verified', 1136, 'success', 'patch-check'],

            ['Rejected', 64, 'danger', 'x-circle'],
        ];

    @endphp

    @foreach ($cards as $card)
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">

                                {{ $card[0] }}

                            </small>

                            <h3 class="fw-bold mt-2">

                                {{ number_format($card[1]) }}

                            </h3>

                        </div>

                        <div class="icon-circle bg-{{ $card[2] }}-subtle">

                            <i class="bi bi-{{ $card[3] }}"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    @endforeach

</div>

<style>
    .icon-circle {

        width: 54px;

        height: 54px;

        border-radius: 50%;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 22px;

    }
</style>
