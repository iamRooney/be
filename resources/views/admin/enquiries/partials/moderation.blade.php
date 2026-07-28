<div class="card border-0 shadow-sm rounded-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">

            Moderation

        </h5>

    </div>

    <div class="card-body">

        <div class="d-grid gap-2">

            <form action="{{ route('admin.enquiries.update', $enquiry) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="{{ $enquiry->status == 'open' ? 'closed' : 'open' }}">
                <button type="submit"
                    class="btn {{ $enquiry->status == 'open' ? 'btn-success' : 'btn-outline-success' }} w-100">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ $enquiry->status == 'open' ? 'Mark Closed' : 'Reopen Enquiry' }}
                </button>
            </form>

            <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST"
                onsubmit="return confirm('Delete this enquiry? This cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-100">
                    <i class="bi bi-trash me-2"></i>
                    Delete Enquiry
                </button>
            </form>

        </div>

    </div>

</div>
