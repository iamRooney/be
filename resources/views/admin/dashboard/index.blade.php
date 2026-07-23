@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container-fluid">

        <!-- Welcome -->

        <div class="row mb-4">

            <div class="col-lg-8">

                <h2 class="fw-bold mb-1">
                    Welcome back 👋
                </h2>

                <p class="text-muted mb-0">
                    Here's what's happening on your marketplace today.
                </p>

            </div>

            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">

                <span class="badge bg-primary px-3 py-2 fs-6">
                    {{ now()->format('d M Y') }}
                </span>

            </div>

        </div>


        <!-- Statistics -->

        <div class="row g-4">

            <div class="col-xl-3 col-md-6">

                <div class="stat-card users">

                    <div>

                        <small>Total Users</small>

                        <h2>1,245</h2>

                        <span>+12 this week</span>

                    </div>

                    <i class="bi bi-people-fill"></i>

                </div>

            </div>

            <div class="col-xl-3 col-md-6">

                <div class="stat-card companies">

                    <div>

                        <small>Companies</small>

                        <h2>328</h2>

                        <span>+5 today</span>

                    </div>

                    <i class="bi bi-building"></i>

                </div>

            </div>

            <div class="col-xl-3 col-md-6">

                <div class="stat-card products">

                    <div>

                        <small>Products</small>

                        <h2>4,520</h2>

                        <span>+48 today</span>

                    </div>

                    <i class="bi bi-box-seam"></i>

                </div>

            </div>

            <div class="col-xl-3 col-md-6">

                <div class="stat-card services">

                    <div>

                        <small>Services</small>

                        <h2>968</h2>

                        <span>+7 today</span>

                    </div>

                    <i class="bi bi-tools"></i>

                </div>

            </div>

        </div>

    </div>

    <style>
        .stat-card {

            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 28px;
            border-radius: 18px;
            color: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
            transition: .3s;

        }

        .stat-card:hover {

            transform: translateY(-6px);

        }

        .stat-card h2 {

            font-size: 36px;
            font-weight: 700;
            margin: 8px 0;

        }

        .stat-card small {

            font-size: 15px;
            opacity: .9;

        }

        .stat-card span {

            font-size: 13px;
            opacity: .85;

        }

        .stat-card i {

            font-size: 52px;
            opacity: .25;

        }

        .users {

            background: linear-gradient(135deg, #2563eb, #3b82f6);

        }

        .companies {

            background: linear-gradient(135deg, #059669, #10b981);

        }

        .products {

            background: linear-gradient(135deg, #ea580c, #f97316);

        }

        .services {

            background: linear-gradient(135deg, #7c3aed, #8b5cf6);

        }
    </style>

    <div class="row mt-4">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="fw-bold mb-0">
                        Registration Analytics
                    </h5>

                </div>

                <div class="card-body">

                    <canvas id="registrationChart" height="110"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0 py-3">

                    <h5 class="fw-bold mb-0">
                        Quick Actions
                    </h5>

                </div>

                <div class="card-body d-grid gap-3">

                    <a href="#" class="btn btn-primary">

                        <i class="bi bi-building-add"></i>

                        Add Company

                    </a>

                    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">

                        <i class="bi bi-grid"></i>

                        Add Category

                    </a>

                    <a href="#" class="btn btn-warning text-white">

                        <i class="bi bi-box-seam"></i>

                        Add Product

                    </a>

                </div>

            </div>

        </div>

    </div>
    <script>
        const ctx = document.getElementById('registrationChart');

        new Chart(ctx, {

            type: 'line',

            data: {

                labels: [

                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun'

                ],

                datasets: [

                    {

                        label: 'Registrations',

                        data: [

                            12,
                            19,
                            15,
                            26,
                            30,
                            41

                        ],

                        borderColor: '#2563eb',

                        backgroundColor: 'rgba(37,99,235,.15)',

                        fill: true,

                        tension: .4

                    }

                ]

            },

            options: {

                plugins: {

                    legend: {

                        display: false

                    }

                },

                responsive: true,

                maintainAspectRatio: false

            }

        });
    </script>

@endsection
