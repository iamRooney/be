<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body">

        <div class="d-flex align-items-center">

            <div class="user-profile-avatar">

                @if ($user->profile_image_url)
                    <img src="{{ $user->profile_image_url }}" alt="{{ $user->name }}"
                        style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif

            </div>

            <div class="ms-4">

                <h4 class="fw-bold mb-1">

                    {{ $user->name }}

                </h4>

                <p class="text-muted mb-2">

                    {{ $user->email ?? $user->phone }}

                </p>

                <span class="badge bg-primary">

                    {{ ucfirst($user->role ?? 'buyer') }}

                </span>

            </div>

        </div>

    </div>

</div>

<style>
    .user-profile-avatar {

        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #4f46e5);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 36px;
        font-weight: 700;

    }
</style>
