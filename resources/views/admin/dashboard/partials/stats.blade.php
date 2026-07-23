<div class="row g-4">

    @php

        $stats = [
            [
                'title' => 'Companies',
                'count' => 328,
                'icon' => 'bi-building',
                'color' => 'primary',
                'subtitle' => 'Registered companies',
            ],

            [
                'title' => 'Pending Companies',
                'count' => 18,
                'icon' => 'bi-hourglass-split',
                'color' => 'warning',
                'subtitle' => 'Awaiting verification',
            ],

            [
                'title' => 'Buyers',
                'count' => 842,
                'icon' => 'bi-person',
                'color' => 'info',
                'subtitle' => 'Registered buyers',
            ],

            [
                'title' => 'Sellers',
                'count' => 403,
                'icon' => 'bi-shop',
                'color' => 'success',
                'subtitle' => 'Registered sellers',
            ],

            [
                'title' => 'Pending Products',
                'count' => 56,
                'icon' => 'bi-box-seam',
                'color' => 'danger',
                'subtitle' => 'Waiting approval',
            ],

            [
                'title' => 'Pending Services',
                'count' => 14,
                'icon' => 'bi-tools',
                'color' => 'secondary',
                'subtitle' => 'Waiting approval',
            ],
        ];

    @endphp

    @foreach ($stats as $stat)
        <div class="col-xl-4 col-md-6">

            <div class="card border-0 shadow-sm rounded-4 stat-card h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">

                                {{ $stat['title'] }}

                            </small>

                            <h2 class="fw-bold mt-2">

                                {{ $stat['count'] }}

                            </h2>

                            <small class="text-muted">

                                {{ $stat['subtitle'] }}

                            </small>

                        </div>

                        <div class="bg-{{ $stat['color'] }} bg-opacity-10
                                   text-{{ $stat['color'] }}
                                   rounded-circle
                                   d-flex
                                   justify-content-center
                                   align-items-center"
                            style="width:60px;height:60px;">

                            <i class="bi {{ $stat['icon'] }} fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    @endforeach

</div>

<style>
    .stat-card {

        transition: .25s;

    }

    .stat-card:hover {

        transform: translateY(-6px);

        box-shadow: 0 .8rem 2rem rgba(0, 0, 0, .12) !important;

    }
</style>
