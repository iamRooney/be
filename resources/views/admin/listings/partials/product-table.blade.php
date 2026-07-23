<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white border-0">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h5 class="fw-bold mb-1">

                    Products

                </h5>

                <small class="text-muted">

                    Showing 10 of 15,240 products

                </small>

            </div>

            <div>

                <button class="btn btn-outline-secondary btn-sm">

                    <i class="bi bi-arrow-clockwise"></i>

                </button>

            </div>

        </div>

    </div>

    <div class="table-responsive">

        <table class="table align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th width="40">

                        <input type="checkbox" class="form-check-input">

                    </th>

                    <th>Product</th>

                    <th>Company</th>

                    <th>Category</th>

                    <th>MOQ</th>

                    <th>Views</th>

                    <th>Status</th>

                    <th width="80">Actions</th>

                </tr>

            </thead>

            <tbody>

                @php

                    $products = [
                        ['Arduino UNO', 'ABC Electronics', 'Electronics', '50', '1240', 'Pending'],

                        ['Industrial Pump', 'Prime Industries', 'Machinery', '10', '842', 'Approved'],

                        ['Steel Rod', 'Global Steel', 'Metal', '100', '2145', 'Rejected'],

                        ['PVC Pipe', 'Green Build', 'Construction', '200', '945', 'Approved'],
                    ];

                @endphp

                @foreach ($products as $product)
                    <tr>

                        <td>

                            <input type="checkbox" class="form-check-input">

                        </td>

                        <td>

                            <div class="d-flex align-items-center">

                                <img src="https://placehold.co/60x60" class="rounded me-3">

                                <div>

                                    <div class="fw-semibold">

                                        {{ $product[0] }}

                                    </div>

                                    <small class="text-muted">

                                        SKU-{{ rand(1000, 9999) }}

                                    </small>

                                </div>

                            </div>

                        </td>

                        <td>{{ $product[1] }}</td>

                        <td>{{ $product[2] }}</td>

                        <td>{{ $product[3] }}</td>

                        <td>{{ number_format($product[4]) }}</td>

                        <td>

                            @if ($product[5] == 'Approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($product[5] == 'Pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif

                        </td>

                        <td>

                            <div class="dropdown">

                                <button class="btn btn-light btn-sm" data-bs-toggle="dropdown">

                                    <i class="bi bi-three-dots"></i>

                                </button>

                                <ul class="dropdown-menu dropdown-menu-end">

                                    <li>

                                        <a class="dropdown-item" href="{{ route('admin.listings.products.show', 1) }}">

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
