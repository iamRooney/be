<div class="card border-0 shadow-sm rounded-4 h-100">

    <div class="card-header bg-white border-0">

        <h5 class="fw-bold mb-0">

            Recent Activities

        </h5>

    </div>

    <div class="card-body">

        <div class="timeline">

            @forelse ($recentActivities as $activity)
                <div class="timeline-item">

                    <i class="bi {{ $activity->icon }}"></i>

                    <div>

                        <strong>{{ $activity->title }}</strong>

                        <small class="text-muted d-block">
                            {{ $activity->subtitle }} • {{ $activity->time->diffForHumans() }}
                        </small>

                    </div>

                </div>
            @empty
                <p class="text-muted mb-0">No recent activity.</p>
            @endforelse

        </div>

    </div>

</div>

<style>
    .timeline-item {

        display: flex;

        gap: 15px;

        padding: 18px 0;

        border-bottom: 1px solid #eee;

    }

    .timeline-item:last-child {

        border-bottom: none;

    }

    .timeline-item i {

        font-size: 22px;

        margin-top: 4px;

    }
</style>
