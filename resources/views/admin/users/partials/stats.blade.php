<div class="row g-4 mb-4">

    @php

        $cards = [
            ['Total Users', 2540, 'primary', 'people'],

            ['Buyers', 1540, 'success', 'person'],

            ['Sellers', 1000, 'warning', 'shop'],

            ['Suspended', 42, 'danger', 'person-x'],
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
