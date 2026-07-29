<div class="card border-0 shadow-sm rounded-4 h-100">

    <div class="card-header bg-white border-0">

        <h5 class="fw-bold mb-0">

            Pending Approvals

        </h5>

    </div>

    <div class="card-body">

        <a href="{{ route('admin.companies.index', ['status' => 'pending']) }}" class="approval-item text-decoration-none">

            <div>

                <i class="bi bi-building text-primary"></i>

                Companies

            </div>

            <span class="badge bg-warning text-dark">

                {{ $approvals['companies'] }}

            </span>

        </a>

        <a href="{{ route('admin.listings.products.index', ['status' => 'pending']) }}" class="approval-item text-decoration-none">

            <div>

                <i class="bi bi-box-seam text-danger"></i>

                Products

            </div>

            <span class="badge bg-danger">

                {{ $approvals['products'] }}

            </span>

        </a>

        <a href="{{ route('admin.listings.services.index', ['status' => 'pending']) }}" class="approval-item text-decoration-none">

            <div>

                <i class="bi bi-tools text-success"></i>

                Services

            </div>

            <span class="badge bg-success">

                {{ $approvals['services'] }}

            </span>

        </a>

    </div>

</div>

<style>
    .approval-item {

        display: flex;

        justify-content: space-between;

        align-items: center;

        padding: 16px;

        border-radius: 12px;

        margin-bottom: 12px;

        background: #f8fafc;

        transition: .25s;

        color: #111827;

    }

    .approval-item:hover {

        background: #eef2ff;

        transform: translateX(6px);

    }
</style>
