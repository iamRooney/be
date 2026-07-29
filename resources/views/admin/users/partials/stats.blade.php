<div class="row g-4 mb-4">

    @php

        $cards = [
            ['Total Users', $stats['total'], 'primary', 'people'],

            ['Buyers', $stats['buyers'], 'success', 'person'],

            ['Sellers', $stats['sellers'], 'warning', 'shop'],

            ['Suspended', $stats['suspended'], 'danger', 'person-x'],
        ];

    @endphp

    @foreach ($cards as $card)
        <div class="col-lg-3">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <small class="text-muted">

                        {{ $card[0] }}

                    </small>

                    <h2 class="fw-bold mt-2">

                        {{ number_format($card[1]) }}

                    </h2>

                </div>

            </div>

        </div>
    @endforeach

</div>
