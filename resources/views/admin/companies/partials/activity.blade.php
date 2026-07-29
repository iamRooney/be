<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold">

            Recent Activity

        </h5>

    </div>

    <div class="card-body">

        <ul class="list-group list-group-flush">

            @forelse ($activity as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $item->label }}</span>
                    <small class="text-muted">{{ $item->time->diffForHumans() }}</small>
                </li>
            @empty
                <li class="list-group-item text-muted">No activity yet.</li>
            @endforelse

        </ul>

    </div>

</div>
