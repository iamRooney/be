<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; background:#f5f6f8; padding:24px;">
    <table style="max-width:480px; margin:0 auto; background:#fff; border-radius:12px; padding:32px;">
        <tr>
            <td>
                <h2 style="margin:0 0 12px; color:#111827;">Your login code</h2>
                <p style="color:#4b5563; font-size:14px; margin:0 0 20px;">
                    Use this code to finish signing in. It expires in 5 minutes.
                </p>
                <div style="font-size:32px; font-weight:700; letter-spacing:8px; color:#0057D9; margin:0 0 20px;">
                    {{ $otp }}
                </div>
                <p style="color:#9ca3af; font-size:12px; margin:0;">
                    If you didn't request this, you can safely ignore this email.
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
