<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">

        <div>
            <h5 class="fw-bold mb-1">All Enquiries</h5>
            <small class="text-muted">Showing 10 of 842 enquiries</small>
        </div>

        <div class="d-flex gap-2">

            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-clockwise"></i>
            </button>

            <button class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-download"></i>
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

                    <th>Enquiry</th>

                    <th>Buyer</th>

                    <th>Seller</th>

                    <th>Listing</th>

                    <th>Date</th>

                    <th>Status</th>

                    <th>Priority</th>

                    <th width="80" class="text-center">Actions</th>

                </tr>

            </thead>

            <tbody>

                @php

                    $enquiries = [
                        [
                            'id' => 'ENQ-1001',
                            'buyer' => 'Rahul Nair',
                            'seller' => 'ABC Electronics',
                            'listing' => 'Arduino UNO',
                            'type' => 'Product',
                            'date' => '2 mins ago',
                            'status' => 'Open',
                            'priority' => 'High',
                        ],

                        [
                            'id' => 'ENQ-1002',
                            'buyer' => 'Anjali',
                            'seller' => 'Prime Industries',
                            'listing' => 'Industrial Pump',
                            'type' => 'Product',
                            'date' => '15 mins ago',
                            'status' => 'Open',
                            'priority' => 'Medium',
                        ],

                        [
                            'id' => 'ENQ-1003',
                            'buyer' => 'Arjun',
                            'seller' => 'Tech Solutions',
                            'listing' => 'Website Development',
                            'type' => 'Service',
                            'date' => 'Yesterday',
                            'status' => 'Closed',
                            'priority' => 'Low',
                        ],

                        [
                            'id' => 'ENQ-1004',
                            'buyer' => 'Vishnu',
                            'seller' => 'Global Steel',
                            'listing' => 'Steel Rods',
                            'type' => 'Product',
                            'date' => '2 days ago',
                            'status' => 'Closed',
                            'priority' => 'High',
                        ],
                    ];

                @endphp

                @foreach ($enquiries as $enquiry)
                    <tr>

                        <td>

                            <input type="checkbox" class="form-check-input">

                        </td>

                        <td>

                            <div class="fw-semibold">

                                {{ $enquiry['id'] }}

                            </div>

                            <small class="text-muted">

                                {{ $enquiry['type'] }}

                            </small>

                        </td>

                        <td>{{ $enquiry['buyer'] }}</td>

                        <td>{{ $enquiry['seller'] }}</td>

                        <td>{{ $enquiry['listing'] }}</td>

                        <td>{{ $enquiry['date'] }}</td>

                        <td>

                            @if ($enquiry['status'] == 'Open')
                                <span class="badge bg-success-subtle text-success">

                                    Open

                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">

                                    Closed

                                </span>
                            @endif

                        </td>

                        <td>

                            @if ($enquiry['priority'] == 'High')
                                <span class="badge bg-danger">

                                    High

                                </span>
                            @elseif($enquiry['priority'] == 'Medium')
                                <span class="badge bg-warning text-dark">

                                    Medium

                                </span>
                            @else
                                <span class="badge bg-info">

                                    Low

                                </span>
                            @endif

                        </td>

                        <td class="text-center">

                            <div class="dropdown">

                                <button class="btn btn-light btn-sm" data-bs-toggle="dropdown">

                                    <i class="bi bi-three-dots"></i>

                                </button>

                                <ul class="dropdown-menu dropdown-menu-end shadow">

                                    <li>

                                        <a class="dropdown-item" href="{{ route('admin.enquiries.show', 1) }}">

                                            <i class="bi bi-chat-left-text me-2"></i>

                                            View Conversation

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item">

                                            <i class="bi bi-check-circle me-2 text-success"></i>

                                            Mark Closed

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item">

                                            <i class="bi bi-flag me-2 text-warning"></i>

                                            Flag

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

    <div class="card-footer bg-white">

        <nav>

            <ul class="pagination justify-content-end mb-0">

                <li class="page-item disabled">

                    <a class="page-link">Previous</a>

                </li>

                <li class="page-item active">

                    <a class="page-link">1</a>

                </li>

                <li class="page-item">

                    <a class="page-link">2</a>

                </li>

                <li class="page-item">

                    <a class="page-link">Next</a>

                </li>

            </ul>

        </nav>

    </div>

</div>
