<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; background:#f5f6f8; padding:24px;">
    <table style="max-width:560px; margin:0 auto; background:#fff; border-radius:12px; padding:32px;">
        <tr>
            <td>
                <h2 style="margin:0 0 4px; color:#111827;">New enquiry received</h2>
                <p style="color:#9ca3af; font-size:13px; margin:0 0 20px;">{{ $enquiry->enquiry_number }}</p>

                @if ($enquiry->listing_name)
                    <p style="color:#4b5563; font-size:14px; margin:0 0 12px;">
                        <strong>Regarding:</strong> {{ $enquiry->listing_name }}
                    </p>
                @endif

                <div style="background:#f9fafb; border-radius:8px; padding:16px; white-space:pre-line; color:#374151; font-size:14px; margin:0 0 20px;">{{ $enquiry->message }}</div>

                <p style="color:#4b5563; font-size:13px; margin:0;">
                    Log in to your dashboard to view full contact details and respond.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
