<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h5 class="fw-bold mb-0">
            Documents
        </h5>

        @if ($company->documents->isNotEmpty())
            <span class="badge bg-light text-dark border">
                {{ $company->documents->where('status', 'pending')->count() }} pending
            </span>
        @endif

    </div>

    <div class="list-group list-group-flush">

        @forelse ($company->documents as $document)
            <div class="list-group-item">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <div class="fw-semibold">
                            {{ \App\Models\CompanyDocument::TYPES[$document->type] ?? ucfirst($document->type) }}
                        </div>

                        <div class="text-muted small">
                            {{ $document->original_name }} &middot;
                            {{ number_format($document->size / 1024, 0) }} KB &middot;
                            Uploaded {{ $document->created_at->format('d M Y') }}
                        </div>

                        @if ($document->status === 'rejected' && $document->notes)
                            <div class="text-danger small mt-1">
                                Rejected: {{ $document->notes }}
                            </div>
                        @endif
                    </div>

                    <span class="badge
                        @if ($document->status === 'approved') bg-success
                        @elseif ($document->status === 'rejected') bg-danger
                        @else bg-warning @endif">
                        {{ ucfirst($document->status) }}
                    </span>

                </div>

                <div class="d-flex gap-2 mt-2">

                    <a href="{{ route('admin.companies.documents.show', $document) }}"
                        target="_blank" rel="noopener"
                        class="btn btn-sm btn-light border">
                        <i class="bi bi-eye me-1"></i>
                        View
                    </a>

                    @if ($document->status !== 'approved')
                        <form action="{{ route('admin.companies.documents.approve', $document) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success">
                                <i class="bi bi-check2 me-1"></i>
                                Approve
                            </button>
                        </form>
                    @endif

                    @if ($document->status !== 'rejected')
                        <button type="button" class="btn btn-sm btn-outline-danger"
                            data-bs-toggle="modal" data-bs-target="#rejectDocModal{{ $document->id }}">
                            <i class="bi bi-x-lg me-1"></i>
                            Reject
                        </button>

                        <div class="modal fade" id="rejectDocModal{{ $document->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.companies.documents.reject', $document) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Reject document</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="form-label">Reason</label>
                                            <textarea name="notes" class="form-control" rows="3" required
                                                placeholder="e.g. Document is blurry, please re-upload"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Reject Document</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        @empty
            <div class="list-group-item text-muted">
                No documents uploaded yet.
            </div>
        @endforelse

    </div>

</div>
