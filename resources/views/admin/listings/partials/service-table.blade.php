<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white border-0">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h5 class="fw-bold mb-1">
                    Services
                </h5>

                <small class="text-muted">
                    Showing 10 of 8,240 services
                </small>

            </div>

            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-clockwise"></i>
            </button>

        </div>

    </div>

    <div class="table-responsive">

        <table class="table align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th width="40">
                        <input type="checkbox" class="form-check-input">
                    </th>

                    <th>Service</th>

                    <th>Company</th>

                    <th>Category</th>

                    <th>Coverage</th>

                    <th>Experience</th>

                    <th>Status</th>

                    <th width="80">Actions</th>

                </tr>

            </thead>

            <tbody>

                @php

                    $services = [
                        ['Website Development', 'ABC Technologies', 'IT Services', 'India', '8 Years', 'Pending'],

                        ['Digital Marketing', 'Growth Agency', 'Marketing', 'Global', '5 Years', 'Approved'],

                        ['Electrical Installation', 'Volt Solutions', 'Engineering', 'UAE', '10 Years', 'Rejected'],

                        ['CNC Cutting', 'Prime Industries', 'Manufacturing', 'Kerala', '12 Years', 'Approved'],
                    ];

                @endphp

                @foreach ($services as $service)
                    <tr>

                        <td>
                            <input type="checkbox" class="form-check-input">
                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <img src="https://placehold.co/60x60" class="rounded me-3">

                                <div>

                                    <div class="fw-semibold">
                                        {{ $service[0] }}
                                    </div>

                                    <small class="text-muted">
                                        SRV-{{ rand(1000, 9999) }}
                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>{{ $service[1] }}</td>

                        <td>{{ $service[2] }}</td>

                        <td>{{ $service[3] }}</td>

                        <td>{{ $service[4] }}</td>

                        <td>

                            @if ($service[5] == 'Approved')
                                <span class="badge bg-success">
                                    Approved
                                </span>
                            @elseif($service[5] == 'Pending')
                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    Rejected
                                </span>
                            @endif

                        </td>

                        <td>

                            <div class="dropdown">

                                <button class="btn btn-light btn-sm" data-bs-toggle="dropdown">

                                    <i class="bi bi-three-dots"></i>

                                </button>

                                <ul class="dropdown-menu dropdown-menu-end">

                                    <li>

                                        <a class="dropdown-item" href="{{ route('admin.listings.services.show', 1) }}">

                                            View

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item text-success">

                                            Approve

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item text-danger">

                                            Reject

                                        </a>

                                    </li>

                                </ul>

                            </div>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>

</div>
