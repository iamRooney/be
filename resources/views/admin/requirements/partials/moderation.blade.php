<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            Moderation

        </h5>

    </div>

    <div class="card-body">

        <div class="d-grid gap-2">

            <form action="{{ route('admin.requirements.update', $requirement) }}" method="POST"
                onsubmit="return confirm('{{ $requirement->status == 'closed' ? 'Reopen this requirement? It will become visible to matching sellers again.' : 'Close this requirement? It will stop showing up for sellers.' }}')">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status"
                    value="{{ $requirement->status == 'closed' ? 'open' : 'closed' }}">
                <button type="submit"
                    class="btn {{ $requirement->status == 'closed' ? 'btn-outline-success' : 'btn-success' }} w-100">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ $requirement->status == 'closed' ? 'Reopen Requirement' : 'Mark Closed' }}
                </button>
            </form>

            <form action="{{ route('admin.requirements.destroy', $requirement) }}" method="POST"
                onsubmit="return confirm('Delete this requirement? This cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-100">
                    <i class="bi bi-trash me-2"></i>
                    Delete Requirement
                </button>
            </form>

        </div>

    </div>

</div>
