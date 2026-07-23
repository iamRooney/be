<div class="card border-0 shadow-sm rounded-4 h-100">

    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">

        <div>

            <h5 class="fw-bold mb-1">
                Marketplace Analytics
            </h5>

            <small class="text-muted">
                Last 6 months growth
            </small>

        </div>

        <select class="form-select form-select-sm" style="width:130px">

            <option>Last 6 Months</option>

            <option>Last Year</option>

        </select>

    </div>

    <div class="card-body">

        <canvas id="marketChart" height="120"></canvas>

    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const ctx = document.getElementById('marketChart');

        new Chart(ctx, {

            type: 'line',

            data: {

                labels: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],

                datasets: [

                    {

                        label: 'Companies',

                        data: [8, 12, 15, 19, 25, 32],

                        borderColor: '#2563eb',

                        backgroundColor: 'rgba(37,99,235,.08)',

                        fill: true,

                        tension: .4

                    },

                    {

                        label: 'Products',

                        data: [25, 38, 45, 58, 74, 96],

                        borderColor: '#10b981',

                        backgroundColor: 'transparent',

                        tension: .4

                    },

                    {

                        label: 'Services',

                        data: [12, 15, 18, 26, 34, 42],

                        borderColor: '#f97316',

                        backgroundColor: 'transparent',

                        tension: .4

                    }

                ]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {

                        position: 'bottom'

                    }

                },

                interaction: {

                    intersect: false,

                    mode: 'index'

                }

            }

        });

    });
</script>
