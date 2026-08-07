@php
    $approved = $document->status === 'approved';
@endphp
<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; background:#f5f6f8; padding:24px;">
    <table style="max-width:560px; margin:0 auto; background:#fff; border-radius:12px; padding:32px;">
        <tr>
            <td>
                <h2 style="margin:0 0 12px; color:{{ $approved ? '#15803d' : '#b91c1c' }};">
                    {{ \App\Models\CompanyDocument::TYPES[$document->type] }} {{ $approved ? 'approved' : 'rejected' }}
                </h2>

                @if ($approved)
                    <p style="color:#4b5563; font-size:14px; margin:0 0 12px;">
                        Your document has been reviewed and approved. No further action needed.
                    </p>
                @else
                    <p style="color:#4b5563; font-size:14px; margin:0 0 12px;">
                        Your document was reviewed and could not be approved as submitted.
                    </p>
                    @if ($document->notes)
                        <div style="background:#fef2f2; border-radius:8px; padding:16px; color:#7f1d1d; font-size:14px; margin:0 0 12px;">
                            {{ $document->notes }}
                        </div>
                    @endif
                    <p style="color:#4b5563; font-size:14px; margin:0 0 12px;">
                        Please upload a corrected document from your seller dashboard.
                    </p>
                @endif

                <p style="color:#9ca3af; font-size:12px; margin:0;">
                    Document: {{ $document->original_name }}
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
